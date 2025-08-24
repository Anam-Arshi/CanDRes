 #!/usr/bin/perl -w

use Bio::Structure::SecStr::DSSP::Res;

 my $file = $ARGV[0];
	$file = "$file.dssp";
 my $dssp = new Bio::Structure::SecStr::DSSP::Res('-file'=> "$file");

 my $pdbID = $dssp->pdbID();
 
 my $totalRes = $dssp->numResidues();

 my $chainRef = $dssp->chains();
 my @chains = sort  @{$chainRef};
 foreach my $ch (@chains) {
  }
 
 my $hb = $dssp->hBonds();
    
 foreach my $ch (@chains) {
   my $ss_elements_pts = $dssp->secBounds($ch);
 
   my $pos = 0;
   my $max = 0;
   foreach my $stretch (@{$ss_elements_pts}) {
     my $start = $stretch->[0];
     my $end = $stretch->[1];     if ($end =~ m/(\d+)/) { $end = $1; }
        if ($end  > $max) { $max = $end; }
   }
   ## END is now the last residue in this chain
	my $ai = 0;
	my $aj = 0;
	my $ak = 0;
	my $al = 0;
	my $tot = 0;
	$tot=$max;
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
     if (($SSsum eq "H")||($SSsum eq "G")||($SSsum eq "I")) { $SSclass = "helix"; $ai++; }
     elsif (($SSsum eq "T")||($SSsum eq "S")) { $SSclass = "turn"; $aj++;}
     elsif (($SSsum eq "B")||($SSsum eq "E")) { $SSclass = "beta"; $ak++;}
     else { $SSclass = $SSsum; $al++;}
     
   }
my $per_h = 0;
my $per_t = 0;
my $per_b = 0;
my $per_u = 0;

if($ai >0)
{
$per_h=($ai*100)/$tot;
}
if($aj >0)
{
$per_t=($aj*100)/$tot;
}
if($ak >0)
{
$per_b=($ak*100)/$tot;
}
if($al >0)
{
$per_u=($al*100)/$tot;
}
print "$pdbID\t$ch\t$tot\t$ai\t$aj\t$ak\t$al\t$per_h\t$per_t\t$per_b\t$per_u\n";

 }