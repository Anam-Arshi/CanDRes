import json
from collections import defaultdict

# Read the file
with open("gene_sps_drg_4April2024.txt", "r") as file:
    lines = file.readlines()

# Initialize a dictionary to store the data
gene_data = defaultdict(lambda: defaultdict(list))

# Process each line
for line in lines[1:]:  # Skip the header
    gene, sps, drugs = [x.strip().strip('"') for x in line.strip().split("\t")]  # Trim spaces and remove extra quotes
    drugs = [drug.strip().strip('"') for drug in drugs.split(",")]  # Trim spaces and remove extra quotes from drug names
    unique_drugs = list(set(drugs))  # Get unique drugs
    if len(unique_drugs) > 1:
        unique_drugs.insert(0, "All")  # Add "All" if more than one drug
    gene_data[gene][sps] = unique_drugs

# Convert defaultdict to a regular dict for JSON serialization
gene_data = {gene: {sps: drugs for sps, drugs in sps_data.items()} for gene, sps_data in gene_data.items()}

# Save to JSON
with open("gene_sps_drg.json", "w") as json_file:
    json.dump(gene_data, json_file, indent=4)

print("JSON file created successfully!")
