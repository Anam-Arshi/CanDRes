# Candidata data - Kshitija
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)
# candida_data_o <- read_excel("data1_14-10-2022_KR_forR.xlsx", sheet = "data1")
# df_o <- candida_data_o

candida_data <- read_excel("data1_27-10-2022_KR.xlsx", sheet = "data1")
df <- candida_data
df[df == '-'] <- NA
df[df == 'NA'] <- NA

#----Exploratory data analysis----
dim(df)
# 183  26

#----1. Missing values----
# columnwise_datarecords_o <- as.data.frame(colSums(is.na(df_o)))
columnwise_datarecords <- as.data.frame(colSums(is.na(df)))

# # to check difference
# columnwise_datarecords_both <- cbind(columnwise_datarecords_o,columnwise_datarecords)

#visualize the missing data
library(Amelia)
#png(filename = "Missing_data_map.png", res = 300, width = 8, height = 10, units = "in")
missmap(df)
dev.off()

#----Data separation----
library(tidyr)
library(dplyr)

#----1.Type_of_Candidiasis-----
type_candi <- df %>% mutate(Type_of_Candidiasis = strsplit(as.character(Type_of_Candidiasis), ", ")) %>% unnest(Type_of_Candidiasis)
candi_type <- type_candi[,c("study_ids", "Type_of_Candidiasis")]
for_barplot_candi_type <- as.data.frame(table(tolower(candi_type$Type_of_Candidiasis))) # count
# for_barplot_candi_type_o <- as.data.frame(table(candi_type$Type_of_Candidiasis))

# candi_type_nit <- type_candi[,c("study_ids", "Type_of_Candidiasis", "Niche_Infected")]
# write.csv(candi_type_nit, file = "candi_type_nit.csv") # to get csv file

library(ggplot2)
# Barplot 
#png(filename = "for_barplot_candi_type.png", res = 300, width = 6.5, height = 8, units = "in")
ggplot(for_barplot_candi_type, aes(x=Freq, y=reorder(Var1, Freq))) +
  geom_bar(stat="identity", width = 0.9, fill="steelblue")+
  geom_text(aes(label=Freq), vjust=0.5, color="black", size=3.5)+
  labs(x="Number of studies", y="Type of Candidiasis", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

#---- 2.Niche_Infected----
library ("dplyr")
nich_inf <- df %>% mutate(Niche_Infected = strsplit(as.character(Niche_Infected), ", ")) %>% unnest(Niche_Infected)
nich_inf <- nich_inf[,c("study_ids", "Niche_Infected")]

nich_inf_yr <- unique(nich_inf[,c("study_ids", "Niche_Infected", "Year_of_Publication")]) # For timeline bar plot

for_barplot_nich_inf <- as.data.frame(table(tolower(nich_inf$Niche_Infected))) # count

png(filename = "for_barplot_nich_inf.png", res = 300, width = 8, height = 10, units = "in")
# Barplot
#ggplot(for_barplot_nich_inf, aes(x=Freq, y=reorder(Var1, Freq))) +
  geom_bar(stat="identity", width = 0.9, fill="steelblue")+
  geom_text(aes(label=Freq), vjust=0.5, color="black", size=3.5)+
  labs(x="Number of studies", y="Niche infected", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

#---- 3. Risk_Factors/Comorbidities----
risk_fact <- df%>% mutate(`Risk_Factors/Comorbidities` = strsplit(as.character(`Risk_Factors/Comorbidities`), "; ")) %>% unnest(`Risk_Factors/Comorbidities`)
risk_fact <- risk_fact %>% mutate(`Risk_Factors/Comorbidities` = strsplit(as.character(`Risk_Factors/Comorbidities`), ", ")) %>% unnest(`Risk_Factors/Comorbidities`)
risk_fact <- risk_fact[,c("study_ids", "Risk_Factors/Comorbidities")]
for_barplot_risk_fact <- as.data.frame(table(tolower(risk_fact$`Risk_Factors/Comorbidities`)))
for_barplot_risk_fact <- filter(for_barplot_risk_fact, Freq>1)

# Barplot
#png(filename = "for_barplot_risk_fact.png", res = 300, width = 8, height = 12, units = "in")
ggplot(for_barplot_risk_fact, aes(x=Freq, y=reorder(Var1, Freq))) +
  geom_bar(stat="identity", width = 0.9, fill="steelblue")+
  geom_text(aes(label=Freq), vjust=0.5, color="black", size=3.5)+
  labs(x="Number of studies", y="Risk factors/comorbidities", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

# library("gplots")
# # 1. convert the data as a table
# dt <- as.table(as.matrix(df))
# # 2. Graph
# balloonplot(t(dt[1:20,1:4]), main ="df", xlab ="", ylab="",
#             label = FALSE, show.margins = FALSE)
# 
# #install.packages("GGally")
# library(GGally)
# ggpairs(df)

#----Anam----
#---- 5.timeline bar plot (Niche and species separately) ----
# see 'scz code' for reference (attached in email)

#---Niche----


library(readxl)
library(dplyr)
library(tidyr)

candida_data <- read_excel("data1_09-11-2022_KR.xlsx", sheet = "data1")
df <- candida_data
df[df == '-'] <- NA
df[df == 'NA'] <- NA
nich_inf <- df %>% mutate(Niche_Infected = strsplit(as.character(Niche_Infected), ", ")) %>% unnest(Niche_Infected)
nich_inf <- nich_inf[,c("study_ids", "Niche_Infected", "Year_of_Publication")]

nich_inf_yr <- unique(nich_inf[,c("study_ids", "Niche_Infected", "Year_of_Publication")]) # For timeline bar plot
nich_inf_yr$groups = ifelse(nich_inf_yr$Year_of_Publication <= 2000,"upto 2000", 
                            ifelse(nich_inf_yr$Year_of_Publication > 2000 & nich_inf_yr$Year_of_Publication < 2011, "2001-2010", 
                                   ifelse(nich_inf_yr$Year_of_Publication > 2010 & nich_inf_yr$Year_of_Publication < 2021, "2011-2020", "2021 onwards" )))
#nich_inf_yr <- subset (nich_inf_yr, select = -frequency) #remove column

count_groups = as.data.frame(table(nich_inf_yr$groups))
#nich_inf_yr$frequency = table(nich_inf_yr$groups)
#nich_inf_yr$frequency = ifelse(nich_inf_yr$groups == count_groups$Var1, nich_inf_yr[,c(count_groups$Freq)], "")


nich_inf_yr$frequency = ifelse(nich_inf_yr$groups == "upto 2000", "12", 
                            ifelse(nich_inf_yr$groups == "2001-2010", "73", 
                                   ifelse(nich_inf_yr$groups == "2011-2020","202", "35")))


  grpwise_nich <- as.data.frame(table(nich_inf_yr$groups, nich_inf_yr$Niche_Infected))
  grpwise_nich <- filter(grpwise_nich, Freq !=0)
  
  grpwise_nich = rename(grpwise_nich, "groups"="Var1")
  grpwise_nich = rename(grpwise_nich, "niche_inf"="Var2")
  grpwise_nich = rename(grpwise_nich, "no_of_studies"="Freq")
  grpwise_nich$frequency = ifelse(grpwise_nich$groups == "upto 2000", "12", 
                                  ifelse(grpwise_nich$groups == "2001-2010", "73", 
                                         ifelse(grpwise_nich$groups == "2011-2020","202", "35")))
  
  #write.csv(grpwise_nich, file = "uniq_nich.csv")
  #write.csv(count_studies$Var1, file = "nich_color.csv")
  
  uniq_nich <- read.csv("uniq_nich.csv")
  nich_col <- read.csv("nich_color.csv")
  
  nich_bar_data <- merge(uniq_nich,nich_col, by="niche_inf")
  
  nich_bar_data$groups <- factor(nich_bar_data$groups, levels = c("upto 2000", "2001-2010", "2011-2020", "2021 onwards"))
  
  library(ggplot2)
  
  nich_barplot <- ggplot(nich_bar_data , aes(x= no_of_studies, y=niche_inf,  fill=niche_inf )) + 
    geom_bar(stat="identity", width = 0.50) + 
    # facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
    #            labeller = labeller(Type = label_wrap_gen(10)))  + 
    facet_grid(groups~., as.table = FALSE, scales = "free_y", space = "free",switch = "x",margins = FALSE)  + 
    scale_fill_manual(values = nich_col$nich_col)+
    labs(x="No. of studies", y="Niches", fill="Niche", title = "")+
    #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
    theme_bw()+ scale_x_continuous(limits = c(0, 52)) +
    theme(strip.text.y = element_text(angle = 0,face="bold", size = 5),
          panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
          strip.background = element_rect(colour = "black", fill=alpha("grey50", 0.2), size=1, linetype="solid"), # upper rectangle parameters
          strip.text.x = element_text(colour = "black", face = "bold", size = 5),
          axis.text.x = element_text(color = "black", size = 5, face = "plain"),
          axis.text.y = element_text(color = "black", size = 3.5, face = "plain"),  
          axis.title.x = element_text(color = "black", size = 5.2, face = "bold"),
          axis.title.y = element_text(color = "black", size = 5.2, face = "bold"),
          legend.text = element_text(color = "black", size = 5.2, face = "plain"),
          legend.title = element_text(color = "black", size = 5.2, face = "bold"),
          plot.title = element_text(color = "black", size = 6, face = "bold", hjust = 0.5),
          legend.key.width =  unit(0.07, 'in'),
          legend.key.height = unit(0.07, 'in'))
  
  
  jpeg(filename = "Niche_timeline1.jpeg", width = 8, height = 4, units="in", res = 600)
  nich_barplot
  dev.off()
  
#----Species----
  library(readxl)
  library(dplyr)
  species_data_t <- read.csv("sps_prevalence.csv") # csv
  df_sp <- species_data_t
  print(df_sp)
  df_sp[df_sp == '-'] <- NA
  df_sp[df_sp == 'NA'] <- NA
  sps_data_t <- unique(df_sp[,c("study_ids", "species")])
  y_o_p = df[,c("Year_of_Publication", "study_ids")]
  sps_data_t <- merge(sps_data_t, y_o_p, by="study_ids")
  
  sps_data_t$groups = ifelse(sps_data_t$Year_of_Publication <= 2000,"upto 2000", 
                              ifelse(sps_data_t$Year_of_Publication > 2000 & sps_data_t$Year_of_Publication < 2011, "2001-2010", 
                                     ifelse(sps_data_t$Year_of_Publication > 2010 & sps_data_t$Year_of_Publication < 2021, "2011-2020", "2021 onwards" )))
 
  cnt_grp = as.data.frame(table(sps_data_t$groups))
  
  
  
  sps_data_t$frequency = ifelse(sps_data_t$groups == "upto 2000", "27", 
                                 ifelse(sps_data_t$groups == "2001-2010", "200", 
                                        ifelse(sps_data_t$groups == "2011-2020","582", "107")))
  
  
  grpwise_sps <- as.data.frame(table(sps_data_t$groups, sps_data_t$species))
  grpwise_sps <- filter(grpwise_sps, Freq !=0)
  
  grpwise_sps = rename(grpwise_sps, "groups"="Var1")
  grpwise_sps = rename(grpwise_sps, "species"="Var2")
  grpwise_sps = rename(grpwise_sps, "no_of_studies"="Freq")
  grpwise_sps$frequency = ifelse(grpwise_sps$groups == "upto 2000", "27", 
                                  ifelse(grpwise_sps$groups == "2001-2010", "200", 
                                         ifelse(grpwise_sps$groups == "2011-2020","582", "107")))
  cnt_std = as.data.frame(table(grpwise_sps$species))
  
  write.csv(grpwise_sps, file = "uniq_sps.csv")
  #write.csv(cnt_std$Var1, file = "sps_color.csv")
  
  uniq_sps <- read.csv("uniq_sps.csv")
  sps_col <- read.csv("sps_color.csv")
  
  sps_bar_data <- merge(uniq_sps,sps_col, by="species")
  sps_bar_data <- filter(sps_bar_data, no_of_studies > 10)
  sps_bar_data$groups <- factor(sps_bar_data$groups, levels = c("upto 2000", "2001-2010", "2011-2020", "2021 onwards"))
  
  library(ggplot2)
  
  sps_barplot <- ggplot(sps_bar_data , aes(x= no_of_studies, y=species,  fill=species )) + 
    geom_bar(stat="identity", width = 0.50) + 
    # facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
    #            labeller = labeller(Type = label_wrap_gen(10)))  + 
    facet_grid(groups~., as.table = FALSE, scales = "free_y", space = "free",switch = "x",margins = FALSE)  + 
    scale_fill_manual(values = sps_col$sps_col)+
    labs(x="No. of studies", y="Species", fill="Species", title = "")+
    #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
    theme_bw()+ scale_x_continuous(limits = c(0, 105)) +
    theme(strip.text.y = element_text(angle = 0,face="bold", size = 5),
          panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
          strip.background = element_rect(colour = "black", fill=alpha("grey50", 0.2), size=1, linetype="solid"), # upper rectangle parameters
          strip.text.x = element_text(colour = "black", face = "bold", size = 5),
          axis.text.x = element_text(color = "black", size = 5, face = "plain"),
          axis.text.y = element_text(color = "black", size = 3.5, face = "plain"),  
          axis.title.x = element_text(color = "black", size = 5.2, face = "bold"),
          axis.title.y = element_text(color = "black", size = 5.2, face = "bold"),
          legend.text = element_text(color = "black", size = 5.2, face = "plain"),
          legend.title = element_text(color = "black", size = 5.2, face = "bold"),
          plot.title = element_text(color = "black", size = 6, face = "bold", hjust = 0.5),
          legend.key.width =  unit(0.07, 'in'),
          legend.key.height = unit(0.07, 'in'))
  
  
  jpeg(filename = "sps_timeline_gt10.jpeg", width = 8, height = 4, units="in", res = 600)
  sps_barplot
  dev.off()
  
  
  
  
  
  
  

#---- 4.Species distribution  ----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")
  
  library(readxl)
  library(dplyr)
species_data <- read.csv("sps_prevalence.csv") # csv


sps_data <- unique(species_data[,c("study_ids", "species")])
for_barplot_sps_data <- as.data.frame(table(sps_data$species)) # count removed(tolower)
for_barplot_sps_data <- filter(for_barplot_sps_data, Var1 !="Unidentified" & Var1 !="Non-albicans Candida")

for_barplot_sps_data <- for_barplot_sps_data[sort(for_barplot_sps_data$Var1),] # order or sort for alphabetical

library(ggplot2)
# Barplot 
png(filename = "sps_summary_07-12-2022.png", res = 300, width = 10, height = 8, units = "in")
ggplot(for_barplot_sps_data, aes(x=Freq, y=Var1)) +
  geom_bar(stat="identity", width = 0.9, fill="deepskyblue")+
  geom_text(aes(label=Freq), hjust=-0.5, color="black", size=3.5)+
  labs(x="Number of publications (Period: 1976-2022)", y=substitute(paste(italic('Candida '), 'species')), fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "italic"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

#---- 5. Niche summary plot  ----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)

library ("dplyr")


niche_data <- read.csv("niche_infected.csv") # csv


nic_data <- unique(niche_data[,c("Study_ids", "niche")])

for_barplot_nic_data <- as.data.frame(table(nic_data$niche)) # count removed(tolower)
for_barplot_nic_data <- filter(for_barplot_nic_data, Var1 != "-")
for_barplot_nic_data <- for_barplot_nic_data[order(for_barplot_nic_data$Var1),]

library(ggplot2)
# Barplot 
png(filename = "nic_summary_14-12-2022.png", res = 300, width = 10, height = 8, units = "in")
ggplot(for_barplot_nic_data, aes(x=Freq, y=Var1)) +
  geom_bar(stat="identity", width = 0.9, fill="deepskyblue")+
  geom_text(aes(label=Freq), hjust=-0.5, color="black", size=3.5)+
  labs(x="Number of publications (Period: 1976-2022)", y="Niche infected", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

#-----sps_identification method----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)
candida_data <- read_excel("data1_09-11-2022_KR.xlsx", sheet = "data1")
df <- candida_data
df[df == '-'] <- NA
df[df == 'NA'] <- NA
library (dplyr)
library(tidyr)
sps_ide <- df %>% mutate(Identification_Method = strsplit(as.character(Identification_Method), ", ")) %>% unnest(Identification_Method)
sps_ide <- sps_ide[,c("study_ids", "Identification_Method")]
#write.csv(sps_ide, file = "sps_identification_method.csv")
for_barplot_sps_ide_data <- as.data.frame(table(sps_ide$Identification_Method)) # count removed(tolower)
for_barplot_sps_ide_data <- filter(for_barplot_sps_ide_data, Var1 != "-")
for_barplot_sps_ide_data <- filter(for_barplot_sps_ide_data, Freq > 4)

for_barplot_sps_ide_data <- for_barplot_sps_ide_data[order(for_barplot_sps_ide_data$Var1),]

library(ggplot2)
# Barplot 
png(filename = "sps_ide_summary_01-12-2022.png", res = 300, width = 10, height = 8, units = "in")
ggplot(for_barplot_sps_ide_data, aes(x=Freq, y=Var1)) +
  geom_bar(stat="identity", width = 0.9, fill="deepskyblue")+
  geom_text(aes(label=Freq), hjust=-0.5, color="black", size=3.5)+
  labs(x="No. of studies", y="Species identification method", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

#----method_ast----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)
candida_data <- read_excel("data1_09-11-2022_KR.xlsx", sheet = "data1")
df <- candida_data
df[df == '-'] <- NA
df[df == 'NA'] <- NA
library (dplyr)
library(tidyr)
ast_data <- df %>% mutate(Method_of_Antifungal_Susceptibility_Testing = strsplit(as.character(Method_of_Antifungal_Susceptibility_Testing), ", ")) %>% unnest(Method_of_Antifungal_Susceptibility_Testing)
ast_data <- ast_data[,c("study_ids", "Method_of_Antifungal_Susceptibility_Testing")]
#write.csv(ast_data, file = "method_ast.csv")
for_barplot_ast_data <- as.data.frame(table(ast_data$Method_of_Antifungal_Susceptibility_Testing)) # count removed(tolower)
for_barplot_ast_data <- filter(for_barplot_ast_data, Var1 != "-")
for_barplot_ast_data <- filter(for_barplot_ast_data, Freq > 1)

for_barplot_ast_data <- for_barplot_ast_data[order(for_barplot_ast_data$Var1),]

library(ggplot2)
# Barplot 
png(filename = "ast_method_summary_01-12-2022.png", res = 300, width = 10, height = 8, units = "in")
ggplot(for_barplot_ast_data, aes(x=Freq, y=Var1)) +
  geom_bar(stat="identity", width = 0.9, fill="deepskyblue")+
  geom_text(aes(label=Freq), hjust=-0.5, color="black", size=3.5)+
  labs(x="No. of studies", y="Method of antifungal susceptibility testing", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()

#----drugs----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)
candida_data <- read_excel("drugs1.xlsx", sheet = "Sheet1")
df <- candida_data
df[df == '-'] <- NA
df[df == 'NA'] <- NA
library (dplyr)

library(tidyr)
drg_data <- df %>% mutate(Name_of_Drug = strsplit(as.character(Name_of_Drug), ", ")) %>% unnest(Name_of_Drug)
drg_data <- drg_data[,c("study_ids", "Name_of_Drug")]
drg_data$Name_of_Drug <- trimws(drg_data$Name_of_Drug, which = c("both"), whitespace = "[ \t\r\n]")
#write.csv(drg_data, file = "drg_data.csv")

colnames(drg_data) <- c('study_ids','drug')

for_barplot_drg_data <- as.data.frame(table(drg_data$drug)) # count removed(tolower)


for_barplot_drg_data <- for_barplot_drg_data[order(for_barplot_drg_data$Var1),]
#write.csv(for_barplot_drg_data, file = "drg_data1.csv")
library(ggplot2)
# Barplot 
png(filename = "drugs_summary_14-12-2022.png", res = 300, width = 14, height = 8, units = "in")
ggplot(for_barplot_drg_data, aes(x=Freq, y=Var1)) +
  geom_bar(stat="identity", width = 0.9, fill="deepskyblue")+
  geom_text(aes(label=Freq), hjust=-0.5, color="black", size=3.5)+
  labs(x="Number of publications (Period: 1976-2022)", y="Drugs", fill="Frequency")+
  theme_bw()+ 
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 10),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        axis.text.y = element_text(color = "black", size = 10, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 12, face = "bold"),
        axis.title.y = element_text(color = "black", size = 12, face = "bold"),
        legend.text = element_text(color = "black", size = 12, face = "plain"),
        legend.title = element_text(color = "black", size = 12, face = "bold"),
        plot.title = element_text(color = "black", size = 12, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.12, 'in'),
        legend.key.height = unit(0.14, 'in'))
dev.off()


#----drug_donut----
# load library plotly
#install.packages("plotly")

setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(plotly)
library(ggplot2)
# create sample data frame

sample_data <- read.csv("drg_data1.csv")

# create donut chart using plot_ly() function
plot_ly(sample_data) %>%
  add_pie(labels = ~`group`, values = 1, 
          type = 'pie', sort = F, hole=0.7, colors= ~`group`,
          marker = list(line = list(width = 2))) %>%
  add_pie(sample_data, labels = ~`drug`, values = ~`count`, 
          domain = list(
            x = c(0.15, 0.85),
            y = c(0.15, 0.85)),
          sort = F, hole=0.7)


#----ddonut----
#https://r-graph-gallery.com/128-ring-or-donut-plot.html
#https://plotly.com/r/pie-charts/

library(ggplot2)
library(webr)
library(dplyr)

#install.packages("webr")
#https://statdoe.com/pie-donut-chart-in-r/
sample_data <- read.csv("drg_data1.csv")

PieDonut(sample_data, aes(group, drug, count=count))

#----1----
ggplot(sample_data, aes(x = group, y = count, fill = group))+
  geom_bar(stat = "identity")+
  coord_polar(theta="y")
#----2----
#https://r-charts.com/part-whole/donut-chart-ggplot2/
  
hsize <- 3.5
df <- sample_data %>% 
  mutate(x = hsize)

ggplot(df, aes(x = hsize, y = count, fill = group)) +
  geom_col() +
  geom_text(aes(label = group),
            position = position_stack(vjust = 0.5)) +
  coord_polar(theta = "y") +
  xlim(c(0.2, hsize + 0.5))

#----3----
#install.packages("tidyverse")
#https://stackoverflow.com/questions/50004058/multiple-dependent-level-sunburst-doughnut-chart-using-ggplot2
#https://stackoverflow.com/questions/26748069/ggplot2-pie-and-donut-chart-on-same-plot
library(tidyverse)


sample_data %>% mutate(name = as.factor(name) %>% fct_reorder(value, sum)) %>%
  arrange(name, value) %>%
  mutate(type = as.factor(type) %>% fct_reorder2(name, value))



lvl0 <- tibble(name = "Parent", value = 0, level = 0, fill = NA)

lvl1 <- sample_data %>%
  group_by(group) %>%
  summarise(value = sum(count)) %>%
  ungroup() %>%
  mutate(level = 1) %>%
  mutate(fill = group)

lvl2 <- sample_data %>%
  select(group = drug, count, fill = drug) %>%
  mutate(level = 2)



bind_rows(lvl0, lvl1, lvl2) %>%
  mutate(name = as.factor(group) %>% fct_reorder2(fill, count)) %>%
  arrange(fill, group) %>%
  mutate(level = as.factor(level)) %>%
  ggplot(aes(x = level, y = count, fill = fill, alpha = level)) +
  geom_col(width = 1, color = "gray90", size = 0.25, position = position_stack()) +
  geom_text(aes(label = group), size = 2.5, position = position_stack(vjust = 0.5)) +
  coord_polar(theta = "y") +
  scale_alpha_manual(values = c("0" = 0, "1" = 1, "2" = 0.7), guide = F) +
  scale_x_discrete(breaks = NULL) +
  scale_y_continuous(breaks = NULL) +
  scale_fill_brewer(palette = "Dark2", na.translate = F) +
  labs(x = NULL, y = NULL) +
  theme_minimal()








#----6. Niche timeline----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)
library(dplyr)
df <- read_xlsx("data1_09-11-2022_KR.xlsx")
niche_data_t <- read.csv("niche_infected.csv") # csv
df_ni <- niche_data_t
print(df_ni)
df_ni[df_ni == '-'] <- NA
df_ni[df_ni == 'NA'] <- NA
nic_data_t <- unique(df_ni[,c("Study_ids", "niche")])
y_o_p = df[,c("Year_of_Publication", "study_ids")]
y_o_p = rename(y_o_p, "Study_ids"="study_ids")

nic_data_t <- merge(nic_data_t, y_o_p, by="Study_ids")

nic_data_t$groups = ifelse(nic_data_t$Year_of_Publication <= 2000,"upto 2000", 
                           ifelse(nic_data_t$Year_of_Publication > 2000 & nic_data_t$Year_of_Publication < 2011, "2001-2010", 
                                  ifelse(nic_data_t$Year_of_Publication > 2010 & nic_data_t$Year_of_Publication < 2021, "2011-2020", "2021 onwards" )))

cnt_grp = as.data.frame(table(nic_data_t$groups))



nic_data_t$frequency = ifelse(nic_data_t$groups == "upto 2000", "12", 
                              ifelse(nic_data_t$groups == "2001-2010", "73", 
                                     ifelse(nic_data_t$groups == "2011-2020","202", "35")))


grpwise_nic <- as.data.frame(table(nic_data_t$groups, nic_data_t$niche))
grpwise_nic <- filter(grpwise_nic, Freq !=0)

grpwise_nic = rename(grpwise_nic, "groups"="Var1")
grpwise_nic = rename(grpwise_nic, "niche"="Var2")
grpwise_nic = rename(grpwise_nic, "no_of_studies"="Freq")

grpwise_nic$frequency = ifelse(grpwise_nic$groups == "upto 2000", "12", 
                              ifelse(grpwise_nic$groups == "2001-2010", "73", 
                                     ifelse(grpwise_nic$groups == "2011-2020","202", "35")))
write.csv(grpwise_nic, file = "uniq_nic.csv")
#write.csv(cnt_std$Var1, file = "nic_color.csv")

uniq_nic <- read.csv("uniq_nic.csv")
nic_col <- read.csv("nich_color.csv")

nic_bar_data <- merge(uniq_nic,nic_col, by="niche")
#nic_bar_data <- filter(nic_bar_data, no_of_studies > 10)
nic_bar_data$groups <- factor(nic_bar_data$groups, levels = c("upto 2000", "2001-2010", "2011-2020", "2021 onwards"))

library(ggplot2)

nic_barplot <- ggplot(nic_bar_data , aes(x= no_of_studies, y=niche,  fill=niche )) + 
  geom_bar(stat="identity", width = 0.50) + 
  # facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
  #            labeller = labeller(Type = label_wrap_gen(10)))  + 
  facet_grid(groups~., as.table = FALSE, scales = "free_y", space = "free",switch = "x",margins = FALSE)  + 
  scale_fill_manual(values = nic_col$nich_col)+
  labs(x="No. of studies", y="Niche", fill="Niche", title = "")+
  #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
  theme_bw()+ scale_x_continuous(limits = c(0, 55)) +
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 5),
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        strip.background = element_rect(colour = "black", fill=alpha("grey50", 0.2), size=1, linetype="solid"), # upper rectangle parameters
        strip.text.x = element_text(colour = "black", face = "bold", size = 5),
        axis.text.x = element_text(color = "black", size = 5, face = "plain"),
        axis.text.y = element_text(color = "black", size = 4, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 5.2, face = "bold"),
        axis.title.y = element_text(color = "black", size = 5.2, face = "bold"),
        legend.text = element_text(color = "black", size = 5.2, face = "plain"),
        legend.title = element_text(color = "black", size = 5.2, face = "bold"),
        plot.title = element_text(color = "black", size = 6, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.07, 'in'),
        legend.key.height = unit(0.07, 'in'))


jpeg(filename = "nic_timeline.jpeg", width = 8, height = 4, units="in", res = 600)
nic_barplot
dev.off()

#----niche timeline----
setwd("C:\\wamp64\\www\\EpiCandIn\\R_plots")

library(readxl)
library(dplyr)
df <- read_xlsx("data1_09-11-2022_KR.xlsx")
niche_data_t <- read.csv("niche_infected.csv") # csv
df_ni <- niche_data_t
print(df_ni)
df_ni[df_ni == '-'] <- NA
df_ni[df_ni == 'NA'] <- NA
nic_data_t <- unique(df_ni[,c("Study_ids", "niche")])
y_o_p = df[,c("Year_of_Publication", "study_ids")]
y_o_p = rename(y_o_p, "Study_ids"="study_ids")

nic_data_t <- merge(nic_data_t, y_o_p, by="Study_ids")

nic_data_t$groups = ifelse(nic_data_t$Year_of_Publication <= 2000,"upto 2000", 
                           ifelse(nic_data_t$Year_of_Publication > 2000 & nic_data_t$Year_of_Publication < 2011, "2001-2010", 
                                  ifelse(nic_data_t$Year_of_Publication > 2010 & nic_data_t$Year_of_Publication < 2021, "2011-2020", "2021 onwards" )))

cnt_grp = as.data.frame(table(nic_data_t$groups))



nic_data_t$frequency = ifelse(nic_data_t$groups == "upto 2000", "12", 
                              ifelse(nic_data_t$groups == "2001-2010", "73", 
                                     ifelse(nic_data_t$groups == "2011-2020","202", "35")))


grpwise_nic <- as.data.frame(table(nic_data_t$groups, nic_data_t$niche))
grpwise_nic <- filter(grpwise_nic, Freq !=0)

grpwise_nic = rename(grpwise_nic, "groups"="Var1")
grpwise_nic = rename(grpwise_nic, "niche"="Var2")
grpwise_nic = rename(grpwise_nic, "no_of_studies"="Freq")

grpwise_nic$frequency = ifelse(grpwise_nic$groups == "upto 2000", "12", 
                               ifelse(grpwise_nic$groups == "2001-2010", "73", 
                                      ifelse(grpwise_nic$groups == "2011-2020","202", "35")))
write.csv(grpwise_nic, file = "uniq_nic.csv")
#write.csv(cnt_std$Var1, file = "nic_color.csv")

uniq_nic <- read.csv("uniq_nic.csv")
nic_col <- read.csv("nich_color.csv")

nic_bar_data <- merge(uniq_nic,nic_col, by="niche")
#nic_bar_data <- filter(nic_bar_data, no_of_studies > 10)
nic_bar_data$groups <- factor(nic_bar_data$groups, levels = c("upto 2000", "2001-2010", "2011-2020", "2021 onwards"))

library(ggplot2)

nic_barplot <- ggplot(nic_bar_data , aes(x= no_of_studies, y=niche,  fill=niche )) + 
  geom_bar(stat="identity", width = 0.8, fill="deepskyblue") + 
  # facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
  #            labeller = labeller(Type = label_wrap_gen(10)))  + 
  facet_grid(groups~., as.table = FALSE, scales = "free_y", space = "free",switch = "x",margins = FALSE)  + 
  #scale_fill_manual(values = nic_col$nich_col)+
  labs(x="Number of publications", y="Niche infected", fill="Niche", title = "")+
  #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
  theme_bw()+ scale_x_continuous(limits = c(0, 52)) +
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 5), legend.position="none",
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        strip.background = element_rect(colour = "black", fill=alpha("grey50", 0.2), size=1, linetype="solid"), # upper rectangle parameters
        strip.text.x = element_text(colour = "black", face = "bold", size = 5),
        axis.text.x = element_text(color = "black", size = 5, face = "plain"),
        axis.text.y = element_text(color = "black", size = 5, face = "plain"),  
        axis.title.x = element_text(color = "black", size = 5.2, face = "bold"),
        axis.title.y = element_text(color = "black", size = 5.2, face = "bold"),
        
        plot.title = element_text(color = "black", size = 6, face = "bold", hjust = 0.5))
        


jpeg(filename = "nic_timeline_14-12-22.jpeg", width = 10, height = 6, units="in", res = 800)
nic_barplot
dev.off()

#----sps timeline----
library(readxl)
library(dplyr)
species_data_t <- read.csv("sps_prevalence.csv") # csv
df_sp <- species_data_t
print(df_sp)
df_sp[df_sp == '-'] <- NA
df_sp[df_sp == 'NA'] <- NA
sps_data_t <- unique(df_sp[,c("study_ids", "species")])
y_o_p = df[,c("Year_of_Publication", "study_ids")]
sps_data_t <- merge(sps_data_t, y_o_p, by="study_ids")

sps_data_t$groups = ifelse(sps_data_t$Year_of_Publication <= 2000,"upto 2000", 
                           ifelse(sps_data_t$Year_of_Publication > 2000 & sps_data_t$Year_of_Publication < 2011, "2001-2010", 
                                  ifelse(sps_data_t$Year_of_Publication > 2010 & sps_data_t$Year_of_Publication < 2021, "2011-2020", "2021 onwards" )))

cnt_grp = as.data.frame(table(sps_data_t$groups))



sps_data_t$frequency = ifelse(sps_data_t$groups == "upto 2000", "27", 
                              ifelse(sps_data_t$groups == "2001-2010", "200", 
                                     ifelse(sps_data_t$groups == "2011-2020","582", "107")))


grpwise_sps <- as.data.frame(table(sps_data_t$groups, sps_data_t$species))
grpwise_sps <- filter(grpwise_sps, Freq !=0)

grpwise_sps = rename(grpwise_sps, "groups"="Var1")
grpwise_sps = rename(grpwise_sps, "species"="Var2")
grpwise_sps = rename(grpwise_sps, "no_of_studies"="Freq")
grpwise_sps$frequency = ifelse(grpwise_sps$groups == "upto 2000", "27", 
                               ifelse(grpwise_sps$groups == "2001-2010", "200", 
                                      ifelse(grpwise_sps$groups == "2011-2020","582", "107")))
cnt_std = as.data.frame(table(grpwise_sps$species))

write.csv(grpwise_sps, file = "uniq_sps.csv")
#write.csv(cnt_std$Var1, file = "sps_color.csv")

uniq_sps <- read.csv("uniq_sps.csv")
sps_col <- read.csv("sps_color.csv")

sps_bar_data <- merge(uniq_sps,sps_col, by="species")
#sps_bar_data <- filter(sps_bar_data, no_of_studies > 10)
sps_bar_data <- filter(sps_bar_data, species !="Unidentified" & species !="Non-albicans Candida")
sps_bar_data$groups <- factor(sps_bar_data$groups, levels = c("upto 2000", "2001-2010", "2011-2020", "2021 onwards"))

library(ggplot2)

sps_barplot <- ggplot(sps_bar_data , aes(x= no_of_studies, y=species,  fill=species )) + 
  geom_bar(stat="identity", width = 0.8, fill="deepskyblue") + 
  # facet_wrap(~Type, dir="h", scales="fixed", ncol = 10, nrow = 1, as.table = FALSE,
  #            labeller = labeller(Type = label_wrap_gen(10)))  + 
  facet_grid(groups~., as.table = FALSE, scales = "free_y", space = "free",switch = "x",margins = FALSE)  + 
  #scale_fill_manual(values = sps_col$sps_col)+
  labs(x="Number of publications", y=substitute(paste(italic('Candida '), 'species')), fill="Species", title = "")+
  #theme(strip.background = element_rect(colour = "Parent term", fill = alpha("blue", 0.2) ),legend.position="none") +
  theme_bw()+ scale_x_continuous(limits = c(0, 102)) +
  theme(strip.text.y = element_text(angle = 0,face="bold", size = 5), legend.position = "none",
        panel.grid.major.y = element_blank(), panel.grid.minor = element_blank(), # panel.grid.major.y is for verticle gridlines
        strip.background = element_rect(colour = "black", fill=alpha("grey50", 0.2), size=1, linetype="solid"), # upper rectangle parameters
        strip.text.x = element_text(colour = "black", face = "bold", size = 5),
        axis.text.x = element_text(color = "black", size = 5, face = "plain"),
        axis.text.y = element_text(color = "black", size = 5.5, face = "italic"),  
        axis.title.x = element_text(color = "black", size = 5.2, face = "bold"),
        axis.title.y = element_text(color = "black", size = 5.2, face = "bold"),
        legend.text = element_text(color = "black", size = 5.2, face = "plain"),
        legend.title = element_text(color = "black", size = 5.2, face = "bold"),
        plot.title = element_text(color = "black", size = 6, face = "bold", hjust = 0.5),
        legend.key.width =  unit(0.07, 'in'),
        legend.key.height = unit(0.07, 'in'))


jpeg(filename = "sps_timeline_14-12-22.jpeg", width = 14, height = 12, units="in", res = 800)
sps_barplot
dev.off()
