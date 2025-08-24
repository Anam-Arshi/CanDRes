library_paths <- c("/usr/lib/R/library/4.3")
#library_paths <- c("/home/biomedinfo/R/x86_64-pc-linux-gnu-library/4.3", "/usr/lib/R/library/4.3", "/usr/local/lib/R/site-library", "/usr/lib/R/site-library")
# Set the library paths
.libPaths(library_paths)

# Load necessary libraries
library(tidyr)
library(dplyr)
library(stringr)
library(trackViewer)
library(RColorBrewer)


# setwd("C:/wamp/www/candres/mutationPlotFiles")
setwd("/var/www/html/mutationPlotFiles/")


args <- commandArgs(TRUE)

ValidatedMutations <- list(
  'tropicalis' = c('301-304del', 'A297S', 'E133D', 'G464D', 'G464S', 'L168P', 'Q320insertPP', 'R656G', 'Y132F'),
  'krusei' = c('A122S', 'A122V', 'A364V', 'E1393G', 'Y140H'),
  'glabrata' = c('A15D', 'C198F', 'C469R', 'C866Y', 'D1082G', 'D632G', 'D666G', 'D876Y', 'D987-I998del', 'E1083Q', 'E340G', 'E555K', 'E655A', 'E655K', 'E818K', 'F559S', 'F575L', 'F659V', 'G1099D', 'G119S', 'G11D', 'G122S', 'G210D', 'G346D', 'G348A', 'G71V', 'G73-V81del', 'G943S', 'H576Y', 'H59D', 'I392M', 'I803T', 'K274N', 'K274Q', 'L280F', 'L328F', 'L341del', 'L344S', 'L347F', 'L630I', 'L946S', 'L986P', 'L998F', 'N764I', 'N768D', 'P633T', 'P822L', 'P927S', 'Q386K', 'R1361H', 'R1377stop', 'R250K', 'R265G', 'R295G', 'R376G', 'R376W', 'S316I', 'S343F', 'S391L', 'S663F', 'S942F', 'T292K', 'T588A', 'T607S', 'W1375L', 'W286del', 'W297R', 'W297S', 'Y141H', 'Y372C', 'Y584C'),
  'parapsilosis' = c('A395T', 'A619V', 'A854V', 'A859T', 'C866Y', 'D615G', 'E1393G', 'E655A', 'E818K', 'F635Y', 'G111R', 'G53A', 'G583R', 'G604R', 'G650E', 'I283R', 'K143R', 'L518F', 'L779F', 'L978W', 'L986P', 'N803D', 'P272L', 'P660A', 'R135I', 'R479K', 'R772I', 'S656P', 'W182stop'),
  'albicans' = c('A15D', 'A446Y', 'A643T', 'A643V', 'A646V', 'A880E', 'D1082G', 'D19E', 'D648S', 'D876Y', 'E517Q', 'E655A', 'E841G', 'F1235C', 'F449V', 'G307S', 'G464S', 'G547R', 'G648D', 'G648S', 'H263Y', 'H283R', 'H741Y', 'H839Y', 'I471T', 'K143Q', 'K143R', 'K684E', 'K884E', 'L122-I125del', 'L144V', 'L193R', 'L370S', 'L962-N969del', 'L979E', 'L998F', 'N1240D', 'N435V', 'N535I', 'N740D', 'N740S', 'N972D', 'N972S', 'N977D', 'N977K', 'P230L', 'P236S', 'P649L', 'P683H', 'P971S', 'P98S', 'Q1388P', 'Q327K', 'Q350L', 'Q714P', 'R1354S', 'R157K', 'R365G', 'R467K', 'R469K', 'R546T', 'R546Y', 'R873T', 'S1037L', 'S165N', 'S405F', 'S466L', 'S469T', 'S480P', 'S542L', 'S542P', 'T123I', 'T145A', 'T220L', 'T225A', 'T381I', 'T386I', 'T470N', 'T540I', 'T83A', 'T896I', 'V162A', 'W1358S', 'W182stop', 'W219C', 'W478C', 'W893R', 'W986L', 'Y132F', 'Y132H', 'Y286D', 'Y447H', 'Y642F'),
  'auris' = c('A640V', 'F635Y', 'K143R', 'N647T', 'R1354S', 'W182stop', 'W691L'),
  'dubliniensis' = c('C866Y', 'D615G', 'D987-I998del', 'E555K', 'G464S', 'H269N', 'H318N', 'P272L', 'Q160K', 'Q327K', 'T374I', 'T985del', 'Y132H', 'Y372C'),
  'kefyr' = c('F641del', 'S218P', 'L107S'),
  'metapsilosis' = c('P660A'),
  'orthopsilosis' = c('P660A')
)



# Define input values directly

# num_domains <- 11
mutation_file_path <- "All_ERG11_tropicalis.txt"
mutation_file_path <- args[1] # Path to mutation file
separator <- "," # Separator for CSV
sps <- "tropicalis"
sps <- args[2]
print(sps)

# Define default plot settings
x_label <- ""
y_label <- "y-axis"
plot_title <- ""
title_height <- 0.1
shrink <- FALSE

gene <- "ERG11"
gene <- args[4]


# Domain definitions
# Load necessary library
library(readr)

# Read the CSV file containing domain information
domain_info <- read_csv("domain_info.csv", show_col_types = FALSE)

# Extract domain information for the given gene and species
gene_info <- domain_info[domain_info$genes == gene & domain_info$species == sps, ]

# Ensure correct column data type before processing
gene_info <- as.data.frame(gene_info)  # Convert tibble to standard dataframe

# Check if domain information is available
if (!is.na(gene_info$domain_locs)) {
  # Convert extracted data to numeric properly
  domain_locs <- as.numeric(unlist(strsplit(gsub(" ", "", gene_info$domain_locs), ",")))
  domain_widths <- as.numeric(unlist(strsplit(gsub(" ", "", gene_info$domain_widths), ",")))
  domain_names <- gsub('"', '', unlist(strsplit(gene_info$domain_names, ",")))
  domain_names <- trimws(domain_names)
  seq_length <- as.numeric(trimws(gene_info$ptn_len))
  print(seq_length)
  num_domains <- length(domain_locs)
  
  # Domain colors
  if (num_domains < 3) {
    dom_color <- brewer.pal(3, "Dark2")[1:num_domains]
  } else if (num_domains > 8) {
    dom_color <- colorRampPalette(brewer.pal(8, "Dark2"))(num_domains)
  } else {
    dom_color <- brewer.pal(num_domains, "Dark2")
  }
  
  # Ensure domain colors match the number of domains
  dom_color <- dom_color[1:length(domain_locs)]
  
  # # Create the domains
  # features <- GRanges(
  #   "chr1",
  #   IRanges(start = domain_locs, width = domain_widths, names = domain_names),
  #   fill = dom_color,
  #   seqlengths = seqlengths(Seqinfo("chr1", c(seq_length)))
  # )
  
  # Create the domains
  features <- GRanges(
    "chr1",
    IRanges(append(1, c(domain_locs)), width=append(seq_length, c(domain_widths)), names=append('', domain_names)),
    fill=append("#FFFFFF", dom_color),
    seqlengths = seqlengths(Seqinfo("chr1", c(seq_length)))


  )
  
} else {
  message("No domain information found for this protein. Displaying a white-colored region.")
  seq_length <- as.numeric(trimws(gene_info$ptn_len))
  print(seq_length)
  
  features <- GRanges(
    "chr1",
    IRanges(start = 1, width = seq_length),  # Single full-protein region
    # fill = "#FFFFFF",  # White color
    seqlengths = seqlengths(Seqinfo("chr1", c(seq_length)))
  )
}


# Load the mutation data
mutation_list <- read.csv(mutation_file_path, sep = separator)
mutation_list <- na.omit(mutation_list) %>% mutate(across(where(is.character), str_trim))
mutation_list <- mutation_list[!duplicated(mutation_list), ]

# print(domain_locs)
# Get default drug colors

drug_list <- unique(mutation_list$Resistance)
# Define a function to generate a wide range of colors
# get_diverse_colors <- function(n) {
#   # Combine multiple palettes for more colors
#   palettes <- c("Paired", "Set3", "Dark2", "Set1", "Set2", "Accent")
#   all_colors <- unlist(lapply(palettes, function(pal) brewer.pal(12, pal)))
#   
#   # Remove duplicate colors
#   all_colors <- unique(all_colors)
#   
#   # If more colors are needed, generate a gradient
#   if (n > length(all_colors)) {
#     additional_colors <- colorRampPalette(all_colors)(n - length(all_colors))
#     all_colors <- c(all_colors, additional_colors)
#   }
#   
#   # Return the required number of colors
#   return(all_colors[1:n])
# }

# drug_colors <- data.frame(
#   drug = drug_list,
#   color = if (length(drug_list) > 12) {
#     colorRampPalette(brewer.pal(12, "Paired"))(length(drug_list))
#   } else {
#     head(brewer.pal(min(12, length(drug_list)), "Paired"), length(drug_list))
#   }
# )

get_diverse_colors <- function(n) {
  # Base palette with maximally distinct colors
  base_palette <- c(
    "#1f77b4", "#ff7f0e", "#2ca02c", "#d62728", "#9467bd", 
    "#8c564b", "#e377c2", "#7f7f7f", "#bcbd22", "#17becf",
    "#aec7e8", "#ffbb78", "#98df8a", "#ff9896", "#c5b0d5",
    "#c49c94", "#f7b6d2", "#c7c7c7", "#dbdb8d", "#9edae5",
    "#393b79", "#637939", "#8c6d31", "#843c39", "#7b4173",
    "#5254a3", "#8ca252", "#bd9e39", "#ad494a", "#a55194"
  )
  
  # If n <= 30, use the base palette
  if (n <= length(base_palette)) {
    return(base_palette[1:n])
  }
  
  # For n > 30, generate colors using LAB color space for better perceptual distance
  library(colorspace)
  all_colors <- qualitative_hcl(
    n = n,
    h = c(0, 360 * (n-1)/n),  # Evenly spaced hues
    c = 80,  # High chroma
    l = 65   # Medium lightness
  )
  
  # Remove any duplicates (though unlikely with this method)
  all_colors <- unique(all_colors)
  
  # If still not enough colors (shouldn't happen), fall back to gradient
  if (length(all_colors) < n) {
    warning("Using gradient fallback for additional colors")
    additional_colors <- colorRampPalette(all_colors)(n - length(all_colors))
    all_colors <- c(all_colors, additional_colors)
  }
  
  return(all_colors[1:n])
}


print(drug_list)
# Assign colors to drugs
drug_colors <- data.frame(
  drug = drug_list,
  color = if (length(drug_list) > 12) {
    get_diverse_colors(length(drug_list))  # Use diverse colors for >12 drugs
  } else {
    head(brewer.pal(min(12, length(drug_list)), "Paired"), length(drug_list))  # Use Paired palette for <=12 drugs
  }
)

# Process mutation data
mutation_names <- mutation_list %>%
  mutate(
    Mutation = str_trim(Mutation)  # Remove extra spaces
  ) %>%
  mutate(
    orig = str_extract(Mutation, "^[A-Za-z]+"),  # Extract original amino acid (e.g., "W" in "W286del")
    loc = str_extract(Mutation, "\\d+"),  # Extract position (e.g., "286" in "W286del")
    new = str_extract(Mutation, "(del|stop|fs|[A-Za-z*]+)$")  # Extract new mutation type
  )

# Handle complex cases like "L403-V528del"
mutation_names <- mutation_names %>%
  mutate(
    orig = ifelse(is.na(orig) & str_detect(Mutation, "^[A-Za-z]+\\d+-[A-Za-z]*\\d+"), 
                  str_extract(Mutation, "^[A-Za-z]+\\d+-[A-Za-z]*"), orig), 
    loc = ifelse(is.na(loc) & str_detect(Mutation, "^[A-Za-z]+\\d+-[A-Za-z]*\\d+"), 
                 str_extract(Mutation, "\\d+$"), loc)
  )


# Ensure no NA values in `new`
mutation_names <- mutation_names %>%
  mutate(
    new = ifelse(is.na(new), "", new),  # Replace NA with empty string to prevent errors
    orig = ifelse(is.na(orig), "", orig)  # Replace NA with empty string to prevent errors
  )


# Print for debugging
print("Processed Mutation Data:")
print(mutation_names)

# Get mutation shapes and colors
color_pal <- data.frame(
  drug = drug_list, 
  color = unlist(lapply(drug_list, function(x) drug_colors$color[drug_colors$drug == x]))
)

mut_colors <- merge(color_pal, mutation_names, by.x = "drug", by.y = "Resistance", all = TRUE)

# Assign shapes based on mutation type
mut_colors$shape <- "circle"
mut_colors[mut_colors$new == "fs", "shape"] <- "circle"
mut_colors[mut_colors$new == "stop", "shape"] <- "square"
mut_colors[mut_colors$new == "del", "shape"] <- "triangle_point_down"

# Handle missing data
mut_colors$shape[is.na(mut_colors$orig)] <- "triangle_point_down"

# Print for debugging
print("Final Mutation Colors and Shapes:")
print(mut_colors)

# Handle special cases for in-frame insertions
if (any(is.na(mut_colors$orig))) {
  mut_colors[is.na(mut_colors$orig), "loc"] <- strsplit(
    mut_colors[is.na(mut_colors$orig), "loc"],
    split = '_'
  )[[1]][1]
  mut_colors[is.na(mut_colors$orig), "orig"] <- ''
}



# Debugging: Print the generated GRanges object
# print(features)

# Create legend for drugs
legend <- list(labels = color_pal$drug, fill = color_pal$color)

# Generate x-axis ticks
num_ticks <- 5  # Number of ticks
# xaxis <- round(seq(1, seq_length + 20, length.out = 5))  # Adds padding
xaxis <- round(seq(1, round(seq_length, digits = -(length(seq_length) + 1)), length.out = 5))

# Ensure the last tick is exactly at seq_length
if (xaxis[length(xaxis)] != seq_length) {
  xaxis[length(xaxis)] <- seq_length
}

# Debugging: Print the generated GRanges object
print(features)
print("X-axis ticks:")
print(xaxis)



# Define validated mutations for the selected species
validated_mutations <- ValidatedMutations[[sps]]

# Print validated mutations for debugging
print("Validated Mutations:")
print(validated_mutations)

# Set shape for validated mutations
mut_colors$shape <- ifelse(
  mut_colors$Mutation %in% validated_mutations,
  "diamond",  # Diamond shape for validated mutations
  "circle"    # Circle shape for other mutations
)

# Print mutation shapes for debugging
print("Mutation Shapes:")
print(mut_colors$shape)


original_aa <- mut_colors$orig
PM <- mut_colors$loc
replaced_aa <- mut_colors$new

# Create mutations with updated shapes
mutations <- GRanges(
  "chr1",
  IRanges(as.integer(PM), width = 1, names = mut_colors$Mutation),
  color = mut_colors$color,
  score = runif(length(PM)) * 10,
  shape = mut_colors$shape  # Add shape information to mutations
)

# Load the grid package for custom legend
library(grid)

# Open PDF for plotting
plot_filename <- args[3]
if (length(drug_list) > 20 || length(mutation_list$Mutation) > 30) {
  pdf(file = plot_filename, width = 36, height = 7)
  
  # Adjust margins: Increase top and right margins
  # par(mar = c(12, 4, 5, 10), oma = c(1, 1, 2, 6))  # Increased right margin
  
} else if (length(drug_list) > 8) {
  pdf(file = plot_filename, width = 22, height = 7.5)
  
  # Adjust margins: Increase top and right margins
  # par(mar = c(12, 4, 5, 10), oma = c(1, 1, 2, 6))  # Increased right margin
  
} else {
  pdf(plot_filename, width = 15, height = 5.7)
  
  # Adjust margins: Increase top and right margins
  # par(mar = c(12, 5, 4, 8), oma = c(1, 1, 2, 6))  # Increased right margin
}


# Generate the lollipop plot
lolliplot(
  mutations, 
  features, 
  label.parameter = list(cex = 0.5),
  rescale = FALSE, 
  xaxis = xaxis, 
  yaxis = FALSE, 
  legend = legend, 
  ylab = FALSE, 
  xlab = FALSE
)

# Adjust drug legend position (move higher)
grid.text(
  "Experimentally Validated Mutations", 
  x = unit(0.04, "npc"),  # Position on the left side (5% from the left)
  y = unit(0.94, "npc"),  # Move legend higher (98% from bottom)
  just = "left",  # Align text to the left
  gp = gpar(col = "black", fontsize = 12, fontface = "bold")
)
grid.points(
  x = unit(0.03, "npc"),  # Position to the left of the text (3% from the left)
  y = unit(0.94, "npc"),  # Align with the text (98% from bottom)
  pch = 23,  # Diamond shape (pch = 18)
  size = unit(1, "char"),  # Size of the diamond
  gp = gpar(col = "black", fill = "white")  # Color of the diamond
)

# Adjust not validated mutation legend position (move higher)
grid.text(
  "Not Validated Mutations", 
  x = unit(0.04, "npc"),  # Position on the left side (5% from the left)
  y = unit(0.91, "npc"),  # Move legend higher (94% from bottom)
  just = "left",  # Align text to the left
  gp = gpar(col = "black", fontsize = 12, fontface = "bold")
)
grid.points(
  x = unit(0.03, "npc"),  # Position to the left of the text (3% from the left)
  y = unit(0.91, "npc"),  # Align with the text (94% from bottom)
  pch = 21,  # Circle shape (pch = 16)
  size = unit(1, "char"),  # Size of the circle
  gp = gpar(col = "black", fill = "white")  # Color of the circle
)


# Close PDF
dev.off()
cat("Plot saved to", plot_filename, "\n")
