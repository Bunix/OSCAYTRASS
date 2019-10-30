<?php
include('session.php');
require ('../fpdf/fpdf.php');
require('../fpdf/code128.php');

if ($login_access_id != 3) {
  header("location:../logout.php");
}
try {
$pid = mysqli_escape_string($db, $_GET["pedigree_id"]);

$query = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and id = '$pid'";

$result = mysqli_query($db, $query) or die('Error querying database.');
$row = mysqli_fetch_array($result);

$ring = strtoupper($row['ring_nr']);
$color = $row['colour'];
$name = strtoupper($row['name']);
$strain = ucwords($row['strain']);
$gender = $row['gender'];
$date_hatched = $row['datehatched'];
$photo = $row['photo'];
$p_id = $row['id'];
$sire = strtoupper($row['sire_ring_nr']);
$dam = strtoupper($row['dam_ring_nr']);
$noimage = 'no_image.png';

if ($gender = 'C') {
	$sex = 'Cock';
}

if ($gender = 'H') {
	$sex = 'Hen';
}
if ($gender = 'U') {
	$sex = 'Unknown';
}


if ($photo != '') {
	$pic = $row['photo'];
	
} else
{
	$pic = $noimage;
}

if ($login_pic != '') {
	$pic2 = $login_pic;
	
} else
{
	$pic2 = $noimage;
}
class PDF extends FPDF
{

function viewTable($db){
		$this->SetFont('Arial','',8);
		
		$stmt = "SELECT * FROM p_achievement where pid = '".$_GET["pedigree_id"]."'";
		$result = mysqli_query($db,$stmt);

		while($fetch = mysqli_fetch_array($result)){
			$this->Cell(180,4,$fetch['achievement'],1,0,'L');
			$this->Ln();			
		}		
	}

}

$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->SetLeftMargin(20);
$pdf->SetTopMargin(20);
$pdf->AddPage();

$pdf=new PDF_Code128();
$pdf->SetLeftMargin(20);
$pdf->SetTopMargin(20);
$pdf->AddPage();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetLeftMargin(20);
$pdf->SetTopMargin(20);
$pdf->AddPage();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetLeftMargin(20);
$pdf->SetTopMargin(20);
$pdf->AddPage();
//Heading
$pdf->Image($pic2,20,20,20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(180,5,strtoupper($login_loft),0,1,'C');
$pdf->Cell(180,5,$login_address,0,1,'C');
$pdf->Cell(180,10,'',0,1,'C');
$pdf->Cell(180,5,'Pedigree Certificate',0,1,'C');
$pdf->Cell(180,5,'',0,1,'C');

//Details
//Image
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,40,'',1,0,'R');
$pdf->Image($pic,27,55,30);
//Details
$pdf->SetFont('Arial','B',12);
$pdf->Cell(130,40,'',1,1,'R');
$pdf->SetFont('Arial','B',12);
$pdf->Text(75, 55, $ring);
$pdf->SetFont('Arial','',9);
$pdf->Text(75, 60, 'Name: '.$name);
$pdf->Text(75, 64, 'BL: '.$strain);
$pdf->Text(75, 68, 'Sex: '.$sex);
$pdf->Text(75, 72, 'Color: '.$color);
$pdf->Text(75, 76, 'Hatched: '.$date_hatched);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'C');
//Achievement
$pdf->viewTable($db);
$pdf->Ln();

$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'Sire',1,1,'C');
//sire
$sirequery = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and ring_nr = '$sire'";
$sireresult = mysqli_query($db, $sirequery);
$sirerow = mysqli_fetch_array($sireresult);
$sirecolor = $sirerow['colour'];
$sirename = strtoupper($sirerow['name']);
$sirestrain = ucwords($sirerow['strain']);

$pdf->SetFont('Arial','',8);
$pdf->Cell(180,5,$sire.', "'.$sirename.'", '.$sirecolor.', '.$sirestrain,1,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'L');
//Sire Achievement
$sirestmt = "SELECT * FROM p_details where ring_nr = '".$sire."'";
$sireresult = mysqli_query($db,$sirestmt);
$sirefetch = mysqli_fetch_array($sireresult);
$sireid = $sirefetch['id'];
$gsire = $sirefetch['sire_ring_nr'];
$gdam = $sirefetch['dam_ring_nr'];

$sire2stmt = "SELECT * FROM p_achievement where pid = '".$sireid."'";
$sire2result = mysqli_query($db,$sire2stmt);
while($sire2fetch = mysqli_fetch_array($sire2result)){

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,4,$sire2fetch['achievement'],1,'L');
}

//Grand Sire
$gsirequery = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and ring_nr = '$gsire'";
$gsireresult = mysqli_query($db, $gsirequery);
$gsirerow = mysqli_fetch_array($gsireresult);
$gsirecolor = $gsirerow['colour'];
$gsirename = strtoupper($gsirerow['name']);
$gsirestrain = ucwords($gsirerow['strain']);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Grand Sire',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(180,5,$gsire.', "'.$gsirename.'", '.$gsirecolor.', '.$gsirestrain,1,1,'L');

//Grand Sire Achievement
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'L');

$gsirestmt = "SELECT * FROM p_details where ring_nr = '".$gsire."'";
$gsireresult = mysqli_query($db,$gsirestmt);
$gsirefetch = mysqli_fetch_array($gsireresult);
$ggsireid = $gsirefetch['id'];
$gssire = $gsirefetch['sire_ring_nr'];

$gsire2stmt = "SELECT * FROM p_achievement where pid = '".$ggsireid."'";
$gsire2result = mysqli_query($db,$gsire2stmt);
while($gsire2fetch = mysqli_fetch_array($gsire2result)){

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,4,$gsire2fetch['achievement'],1,'L');
}


//Grand Dam
$gdamquery = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and ring_nr = '$gdam'";
$gdamresult = mysqli_query($db, $gdamquery);
$gdamrow = mysqli_fetch_array($gdamresult);
$gdamcolor = $gdamrow['colour'];
$gdamname = strtoupper($gdamrow['name']);
$gdamstrain = ucwords($gdamrow['strain']);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Grand Dam',1,1,'C');
//ring nr, color, and name
$pdf->SetFont('Arial','',8);
$pdf->Cell(180,5,$gdam.', "'.$gdamname.'", '.$gdamcolor.', '.$gdamstrain,1,1,'L');
//dam strain
//Grand Dam Achievement
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'L');

$gdamstmt = "SELECT * FROM p_details where ring_nr = '".$gdam."'";
$gdamresult = mysqli_query($db,$gdamstmt);
$gdamfetch = mysqli_fetch_array($gdamresult);
$ggdamid = $gdamfetch['id'];
$gsdam = $gdamfetch['sire_ring_nr'];

$gdam2stmt = "SELECT * FROM p_achievement where pid = '".$ggdamid."'";
$gdam2result = mysqli_query($db,$gdam2stmt);
while($gdam2fetch = mysqli_fetch_array($gdam2result)){

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,4,$gdam2fetch['achievement'],1,'L');
}
$pdf->Ln();


//Dam
$pdf->SetFont('Arial','B',9);
$pdf->Cell(180,5,'Dam',1,1,'C');
//dam
$damquery = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and ring_nr = '$dam'";
$damresult = mysqli_query($db, $damquery);
$damrow = mysqli_fetch_array($damresult);
$damcolor = $damrow['colour'];
$damname = strtoupper($damrow['name']);
$damstrain = ucwords($damrow['strain']);

//ring nr, color, and name
$pdf->SetFont('Arial','',8);
$pdf->Cell(180,5,$dam.' "'.$damname.'" '.$damcolor,1,1,'L');
//dam strain
$pdf->Cell(180,5,$damstrain,1,1,'L');

//Dam Achievement
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'L');

$damstmt = "SELECT * FROM p_details where ring_nr = '".$dam."'";
$damresult = mysqli_query($db,$damstmt);
$damfetch = mysqli_fetch_array($damresult);
$damid = $damfetch['id'];
$gdsireringnr = $damfetch['sire_ring_nr'];
$gddamringnr = $damfetch['dam_ring_nr'];

$dam2stmt = "SELECT * FROM p_achievement where pid = '".$damid."'";
$dam2result = mysqli_query($db,$dam2stmt);
while($dam2fetch = mysqli_fetch_array($dam2result)){

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,4,$dam2fetch['achievement'],1,'L');
}	

//Grand Sire Dam
$gdsirequery = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and ring_nr = '$gdsireringnr'";
$gdsireresult = mysqli_query($db, $gdsirequery);
$gdsirerow = mysqli_fetch_array($gdsireresult);
$gdsirecolor = $gdsirerow['colour'];
$gdsirename = strtoupper($gdsirerow['name']);
$gdsirestrain = ucwords($gdsirerow['strain']);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Grand Sire',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(180,5,$gdsireringnr.', "'.$gdsirename.'", '.$gdsirecolor.', '.$gdsirestrain,1,1,'L');

//Grand Sire Dam Achievement
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'L');

$gdsirestmt = "SELECT * FROM p_details where ring_nr = '".$gdsireringnr."'";
$gdsireresult = mysqli_query($db,$gdsirestmt);
$gdsirefetch = mysqli_fetch_array($gdsireresult);
$ggdsireid = $gdsirefetch['id'];
$gsdsire = $gdsirefetch['sire_ring_nr'];

$gdsire2stmt = "SELECT * FROM p_achievement where pid = '".$ggdsireid."'";
$gdsire2result = mysqli_query($db,$gdsire2stmt);
while($gdsire2fetch = mysqli_fetch_array($gdsire2result)){

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,4,$gdsire2fetch['achievement'],1,'L');
}


//Grand Dam Dam
$gddamquery = "SELECT *, date_format(date_hatched, '%e-%b-%y') as datehatched FROM p_details where uid = '$login_id' and ring_nr = '$gddamringnr'";
$gddamresult = mysqli_query($db, $gddamquery);
$gddamrow = mysqli_fetch_array($gddamresult);
$gddamcolor = $gddamrow['colour'];
$gddamname = strtoupper($gddamrow['name']);
$gddamstrain = ucwords($gddamrow['strain']);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Grand Dam',1,1,'C');
//ring nr, color, and name
$pdf->SetFont('Arial','',8);
$pdf->Cell(180,5,$gddamringnr.', "'.$gddamname.'", '.$gddamcolor.', '.$gddamstrain,1,1,'L');
//dam strain
//Grand Dam Dam Achievement
$pdf->SetFont('Arial','B',8);
$pdf->Cell(180,5,'Achievement(s)',1,1,'L');

$gddamstmt = "SELECT * FROM p_details where ring_nr = '".$gddamringnr."'";
$gddamresult = mysqli_query($db,$gddamstmt);
$gddamfetch = mysqli_fetch_array($gddamresult);
$ggddamid = $gddamfetch['id'];
$gsddam = $gddamfetch['sire_ring_nr'];

$gddam2stmt = "SELECT * FROM p_achievement where pid = '".$ggddamid."'";
$gddam2result = mysqli_query($db,$gddam2stmt);
while($gddam2fetch = mysqli_fetch_array($gddam2result)){

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(180,4,$gddam2fetch['achievement'],1,'L');
}
$pdf->Ln();

$pdf->Cell(90,10,'',0,1,'L');

$pdf->Cell(90,5,'',0,0,'C');
$pdf->Cell(70,5,'__________________________',0,1,'C');
$pdf->Cell(90,5,'',0,0,'C');
$pdf->Cell(70,5,'Signature',0,1,'C');

$pdf->Output();
	
} catch (Exception $e) {
	echo 'Message: Error Found or No Profile Picture Found!' ;
	header("Refresh: 2; active");
}


?>

