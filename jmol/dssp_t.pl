use Bio::Structure::SecStr::DSSP::Res;
my $f = $ARGV[0];
my $file = "$f.dssp";
my $dssp = new Bio::Structure::SecStr::DSSP::Res('-file'=> "$file");

my $pdbID = $dssp->pdbID();
my $auth  = $dssp->pdbAuthor();
my $cmpd = $dssp->pdbCompound();
my $pdb_date = $dssp->pdbDate();
my $header = $dssp->pdbHeader();
my $pdbSource = $dssp->pdbSource();

print "PDB entry $pdbID \n\tauthor:\t$auth",
  "\n\tCompound:\t$cmpd",
  "\n\tDate:\t$pdb_date",
  "\n\tHeader:\t$header",
  "\n\tsource:\t$pdbSource\n\n";

my $totalRes = $dssp->numResidues();
print "Total residue count (all chains):$totalRes\n";


my $surArea= $dssp->totSurfArea();
print "Total accessible surface area:\t$surArea  (square Ang)\n";


my $chainRef = $dssp->chains();
my @chains = sort  @{$chainRef};
print "Chain[s]:\n";
foreach my $ch (@chains) {
  print "\t$ch";
}
print "\n";

my $hb = $dssp->hBonds();
print "H BONDS.\n";
print "TYPE O(I)-->H-N(J): $hb->[0]\n",
   "IN PARALLEL BRIDGES: $hb->[1]\n",
   "IN ANTIPARALLEL BRIDGES $hb->[2]\n",
   "TYPE O(I)-->H-N(I-5) $hb->[3]\n",
   "TYPE O(I)-->H-N(I-4) $hb->[4]\n",
   "TYPE O(I)-->H-N(I-3) $hb->[5]\n",
   "TYPE O(I)-->H-N(I-2) $hb->[6]\n",
   "TYPE O(I)-->H-N(I-1) $hb->[7]\n",
   "TYPE O(I)-->H-N(I+0) $hb->[8]\n",
   "TYPE O(I)-->H-N(I+1) $hb->[9]\n",
   "TYPE O(I)-->H-N(I+2) $hb->[10]\n",
   "TYPE O(I)-->H-N(I+3) $hb->[11]\n",
   "TYPE O(I)-->H-N(I+4) $hb->[12]\n",
   "TYPE O(I)-->H-N(I+5) $hb->[13]\n",
  "\n";

   
 
foreach my $ch (@chains) {
  my $ss_elements_pts = $dssp->secBounds($ch);
  print "Chain $ch:\n";
  my $pos = 0;
  my $max = 0;
  foreach my $stretch (@{$ss_elements_pts}) {
    my $start = $stretch->[0];
    my $end = $stretch->[1]; 
    if ($end =~ m/(\d+)/) { $end = $1; }
   
    if ($end  > $max) { $max = $end; }
  }
  ## END is now the last residue in this chain
  for my $res (1..$max) {
    my $residueID = $res . ":" . $ch;
    my ($phi,$psi,$SS,$SSsum,$AA);
    eval { $phi = $dssp->resPhi($residueID);};
    eval { $psi = $dssp->resPsi($residueID);};
    eval { $SS = $dssp->resSecStr($residueID);};
    eval { $SSsum = $dssp->resSecStrSum($residueID);};
    $AA = $dssp->resAA($residueID);
    $phi = $phi || "n/a";
    $psi = $psi || "n/a";
    $SS = $SS || "-";
    my $SSclass;
    if ($SSsum eq "H") { $SSclass = "helix"; }
    elsif ($SSsum eq "T") { $SSclass = "turn"; }
    elsif ($SSsum eq "B") { $SSclass = "beta"; }
    else { $SSclass = $SSsum; }
    print "$residueID) [$AA] phi:$phi psi:$psi SecStruct: $SS ($SSclass) \n";
  }
}

