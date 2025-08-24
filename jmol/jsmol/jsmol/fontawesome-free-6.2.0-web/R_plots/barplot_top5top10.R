setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots\\scz data")

# SCZ

# ---- All significant pathways ----
library(dplyr)
SCZ_all_significant <- read.csv("scz_all_significant_pathways_pterms_UG.csv")

all_path_uniq <- unique(SCZ_all_significant$Pathways)
scz_pathways <- SCZ_all_significant
table(scz_pathways$Type)


# ----For color codes----
all_path_top5 <- read.csv(file = "ParentTermColors.csv", header = TRUE)

#---- I. Top 5----
# remove duplicated pathways
scz_pathways_nr <- scz_pathways[!duplicated(cbind(scz_pathways$Type,
                                                  scz_pathways$Pathways)),]

library(data.table)
scz_pathway_top5 <- scz_pathways_nr[order(scz_pathways_nr$Type,
                                          scz_pathways_nr$PValue),]
scz_pathway_top5 <- data.table(scz_pathway_top5, key = "Type")
scz_pathway_top5 <- scz_pathway_top5[ , head(.SD, 5), by = Type]
table(scz_pathway_top5$Type)

scz_pathway_top5$Parent.term <- as.factor(scz_pathway_top5$Parent.term)
scz_pathway_top5 <- merge(scz_pathway_top5,all_path_top5, by="Parent.term")
scz_pathways_top5_col <- as.character(unique(scz_pathway_top5$Parentcol))
scz_pathway_top5$Type <- factor(scz_pathway_top5$Type, levels = c("Coding genes", "Coding eQTL", "Coding mQTL", "Coding pQTL",
                                                                  "Non-coding eQTL", "Non-coding mQTL", "Non-coding pQTL"))
library(ggplot2)
scz_path_top5 <- ggplot(scz_pathway_top5 , aes(x=-log10(PValue), y=Pathways,  fill=Parent.term)) + 
  geom_bar(stat="identity", width = 0.50) + 
  facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
             labeller = labeller(Type = label_wrap_gen(10)))  + 
  scale_fill_manual(values = scz_pathways_top5_col)+
  labs(x="-log10 p-value", y="Pathways", fill="Parent term", title = "Schizophrenia (SCZ)")+
  #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
  theme_bw()+ scale_x_continuous(limits = c(0, 20)) +
  theme(panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        strip.background = element_rect(colour = "black", fill = alpha("grey50", 0.2)), # upper rectangle parameters
        strip.text.x = element_text(colour = "black", face = "bold", size=7),
        axis.text.x = element_text(color = "black", size = 7, face = "plain"),
        axis.text.y = element_text(color = "black", size = 7, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 8, face = "bold"),
        axis.title.y = element_text(color = "black", size = 8, face = "bold"),
        legend.text = element_text(color = "black", size = 8, face = "plain"),
        legend.title = element_text(color = "black", size = 8, face = "bold"),
        plot.title = element_text(color = "black", size = 9, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.1, 'in'),
        legend.key.height = unit(0.1, 'in'))

jpeg(filename = "scz_pathways_top5.jpeg", width = 10, height = 3, units="in", res = 600)
scz_path_top5
dev.off()


#---- II. Unique top 10----
SCZ_unique <- read.csv("Unique_pathways.csv")

# remove duplicated pathways
SCZ_unique_nr <- SCZ_unique[!duplicated(cbind(SCZ_unique$Type,
                                              SCZ_unique$Pathways)),]
table(SCZ_unique_nr$Type)

library(data.table)
scz_pathways_top10 <- SCZ_unique_nr[order(SCZ_unique_nr$Type,
                                          SCZ_unique_nr$PValue),]
scz_pathways_top10 <- data.table(scz_pathways_top10, key = "Type")
scz_pathways_top10 <- scz_pathways_top10[ , head(.SD, 10), by = Type]
table(scz_pathways_top10$Type)
write.csv(scz_pathways_top10, file = "scz_pathways_top10.csv", row.names = FALSE)

scz_pathways_top10 <- merge(scz_pathways_top10,all_path_top5, by="Parent.term")

scz_forlevel <- unique(scz_pathways_top10[,c("Parent.term","Parentcol")])
scz_forlevel_pt <- as.character(scz_forlevel$Parent.term)
scz_pathways_top10$Parent.term <- factor(scz_pathways_top10$Parent.term, levels = scz_forlevel_pt)

scz_pathways_top10_col <- as.character(scz_forlevel$Parentcol)
scz_pathways_top10$Type <- factor(scz_pathways_top10$Type, levels = c("Non-coding pQTL", "Non-coding mQTL", "Non-coding eQTL", 
                                                                      "Coding pQTL","Coding mQTL","Coding eQTL","Coding genes"))


scz_path_top10 <- ggplot(scz_pathways_top10 , aes(x=-log10(PValue), y=Pathways,  fill=Parent.term )) + 
  geom_bar(stat="identity", width = 0.50) + 
  # facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
  #            labeller = labeller(Type = label_wrap_gen(10)))  + 
  facet_grid(Type~., as.table = FALSE, scales = "free_y", space = "free",switch = "x",margins = FALSE)  + 
  scale_fill_manual(values = scz_pathways_top10_col)+
  labs(x="-log10 p-value", y="Pathways", fill="Parent term", title = "Schizophrenia (SCZ)")+
  #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
  theme_bw()+ scale_x_continuous(limits = c(0, 20)) +
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 5),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        strip.background = element_rect(colour = "black", fill=alpha("grey50", 0.2), size=1, linetype="solid"), # upper rectangle parameters
        strip.text.x = element_text(colour = "black", face = "bold", size = 5),
        axis.text.x = element_text(color = "black", size = 5, face = "plain"),
        axis.text.y = element_text(color = "black", size = 5, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 5.2, face = "bold"),
        axis.title.y = element_text(color = "black", size = 5.2, face = "bold"),
        legend.text = element_text(color = "black", size = 5.2, face = "plain"),
        legend.title = element_text(color = "black", size = 5.2, face = "bold"),
        plot.title = element_text(color = "black", size = 6, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.07, 'in'),
        legend.key.height = unit(0.07, 'in'))


jpeg(filename = "scz_pathways_top10.jpeg", width = 8, height = 4, units="in", res = 600)
scz_path_top10
dev.off()
