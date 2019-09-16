<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "it_company";
	
	//create connection 
	$connect = new mysqli($servername, $username, $password, $dbname);
	//checking connection
	if ($connect->connect_error) {
		die("Connection failed:" . $connect->connect_error);
	}
	else {
		echo "You are connected!";
		
		//Details of company
		$company_sql = "SELECT * FROM company_details";
		$result_company = $connect->query($company_sql);
		
		//Details of Executive Chief
		$Exe_sql = "SELECT * FROM excecutive_chief";
		$result_Exe = $connect->query($Exe_sql);
		
		//Details of three departments
		$dep_sql = "SELECT `Name`, `id`, `Room`, `Employee_no`, `Employee_Positions`, `Department_work`, `Partners` FROM `department_name` WHERE id='D123'";
		$result_dep1 = $connect->query($dep_sql);
		$dep_sql = "SELECT `Name`, `id`, `Room`, `Employee_no`, `Employee_Positions`, `Department_work`, `Partners` FROM `department_name` WHERE id='D124'";
		$result_dep2 = $connect->query($dep_sql);
		$dep_sql = "SELECT `Name`, `id`, `Room`, `Employee_no`, `Employee_Positions`, `Department_work`, `Partners` FROM `department_name` WHERE id='D156'";
		$result_dep3 = $connect->query($dep_sql);
		
		//Details of Company Project manager
		$Pmanager_sql = "SELECT*FROM project_manager";
		$result_Pmanager = $connect->query($Pmanager_sql);
		
		//Details of remaining departments under project manager
		$depart_sql = "SELECT `DN`, `id`, `Room_no`, `Employee`, `Employee_Position`, `Team_leader`, `Projecti`, `Projectii`, `Partner` FROM `depart_name` WHERE id='D120'";
		$result_depart1 = $connect->query($depart_sql);
		$depart_sql = "SELECT `DN`, `id`, `Room_no`, `Employee`, `Employee_Position`, `Team_leader`, `Projecti`, `Projectii`, `Partner` FROM `depart_name` WHERE id='D121'";
		$result_depart2 = $connect->query($depart_sql);

		//Details of team leaders in Web and Mobile department
		$leader_sql = "SELECT `TD`, `EName`, `EAddress`, `EPhone`, `Eemail`, `Joined_From`, `No_of_projectsdone`, `No_of_ControllingEmployees`, `Working_under` FROM `team_lead` WHERE TD='Team lead of Mobile Department'";
		$result_leader1 = $connect->query($leader_sql);
		$leader_sql = "SELECT `TD`, `EName`, `EAddress`, `EPhone`, `Eemail`, `Joined_From`, `No_of_projectsdone`, `No_of_ControllingEmployees`, `Working_under` FROM `team_lead` WHERE TD='Team lead of Web Department'";
		$result_leader2 = $connect->query($leader_sql);
		
		
		//Creating a XML document
		$xml=new DomDocument ('1.0','UTF-8');
		$xml->formatOutput = true;
		
		//$styleheet = 'type="text/css" href="catalog_17030965.css"';
		//$xmlstylesheet = new DOMProcessingInstruction( 'xml-stylesheet',
		//$styleheet);
		//$xml->appendChild($xmlstylesheet);
		
		//Creating root element of XML file
		while($row = mysqli_fetch_array($result_company)){
			$itComp=$xml->createElement("It_company");
			$itComp->setAttribute("Name", "JDA Software");
			$xml->appendChild($itComp);
			
			//creating child element under it company
			$header=$xml->createElement("Header");
			$itComp->appendChild($header);
			
			$comp_details=$xml->createElement("Company_Details");
			$header->appendChild($comp_details);
			//creating child element of company details
			$Comp_name=$xml->createElement("CName", $row[0]);
			$comp_details->appendChild($Comp_name);
			$Comp_add=$xml->createElement("Address", $row["Address"]);
			$comp_details->appendChild($Comp_add);
			$Comp_num=$xml->createElement("Telephone_Number", $row["Telephone_Number"]);
			$comp_details->appendChild($Comp_num);
			$Comp_email=$xml->createElement("Email", $row["Email"]);
			$comp_details->appendChild($Comp_email);
			$Comp_web=$xml->createElement("Website", $row["Website"]);
			$comp_details->appendChild($Comp_web);
			$Comp_est=$xml->createElement("Establishment", $row["Estb."]);
			$comp_details->appendChild($Comp_est);
			$Comp_logo=$xml->createElement("Logo");
			$comp_details->appendChild($Comp_logo);
			
			
		}
		
		//Creating element for executive chief
		while($row = mysqli_fetch_array($result_Exe)){
			$chief=$xml->createElement("Executive_Chief");
			$chief->setAttribute("id", "EMP01");
			$itComp->appendChild($chief);
			//Creating child element for executive chief
			$titl=$xml->createElement("Title", "Executive Chief");
			$chief->appendChild($titl);
			$Fullname=$xml->createElement("FullName", $row[0]);
			$chief->appendChild($Fullname);
			$Add=$xml->createElement("P_address", $row["P_address"]);
			$chief->appendChild($Add);
			$mail=$xml->createElement("Mail", $row["Mail"]);
			$chief->appendChild($mail);
			$phone=$xml->createElement("Phone", $row["Phone"]);
			$chief->appendChild($phone);
			$word=$xml->createElement("Word", $row["Word"]);
			$chief->appendChild($word);
			$des=$xml->createElement("His_Words", $row["Description"]);
			$chief->appendChild($des);
			$abt=$xml->createElement("About", $row["About"]);
			$chief->appendChild($abt);
			$About=$xml->createElement("Description", $row["About Executive"]);
			$chief->appendChild($About);
		}
		
		//Creating element for department Research and development
		while($row = mysqli_fetch_array($result_dep1)){
			$dep_name=$xml->createElement("Department_name");
			$itComp->appendChild($dep_name);
			
			$dep=$xml->createElement("Department");
			$dep->setAttribute("id",$row["id"]);
			$dep_name->appendChild($dep);
			$name=$xml->createElement("Name", $row["Name"]);
			$dep->appendChild($name);
			$rom=$xml->createElement("Room", $row["Room"]);
			$dep->appendChild($rom);
			$E_no=$xml->createElement("Employee_no", $row["Employee_no"]);
			$dep->appendChild($E_no);
			$E_pos=$xml->createElement("Employee_Positions", $row["Employee_Positions"]);
			$dep->appendChild($E_pos);
			$dwork=$xml->createElement ("Department_work", $row["Department_work"]);
			$dep->appendChild($dwork);
		}
		
		//Creating element for department Marketing
		while($row = mysqli_fetch_array($result_dep2)){
			$dep_name=$xml->createElement("Department_name");
			$itComp->appendChild($dep_name);
			
			
			$dep=$xml->createElement("Department");
			$dep->setAttribute("id",$row["id"]);
			$dep_name->appendChild($dep);
			$name=$xml->createElement("Name", $row["Name"]);
			$dep->appendChild($name);
			$rom=$xml->createElement("Room", $row["Room"]);
			$dep->appendChild($rom);
			$E_no=$xml->createElement("Employee_no", $row["Employee_no"]);
			$dep->appendChild($E_no);
			$E_pos=$xml->createElement("Employee_Positions", $row["Employee_Positions"]);
			$dep->appendChild($E_pos);
			$dwork=$xml->createElement ("Department_work", $row["Department_work"]);
			$dep->appendChild($dwork);
			$part=$xml->createElement("Partners", $row["Partners"]);
			$dep->appendChild($part);
		}
		
		//Creating element for department Human resource
		while($row = mysqli_fetch_array($result_dep3)){
			$dep_name=$xml->createElement("Department_name");
			$itComp->appendChild($dep_name);

			$dep=$xml->createElement("Department");
			$dep->setAttribute("id",$row["id"]);
			$dep_name->appendChild($dep);
			$name=$xml->createElement("Name", $row["Name"]);
			$dep->appendChild($name);
			$rom=$xml->createElement("Room", $row["Room"]);
			$dep->appendChild($rom);
			$E_no=$xml->createElement("Employee_no", $row["Employee_no"]);
			$dep->appendChild($E_no);
			$E_pos=$xml->createElement("Employee_Positions", $row["Employee_Positions"]);
			$dep->appendChild($E_pos);
			$dwork=$xml->createElement ("Department_work", $row["Department_work"]);
			$dep->appendChild($dwork);
			
		}
		
		//Creating element for Project manager
		while($row = mysqli_fetch_array($result_Pmanager)){
			$manager=$xml->createElement("Project_manager");
			$manager->setAttribute("id", $row["Pid"]);
			$itComp->appendChild($manager);
			$titlee=$xml->createElement("PTitle", $row["PTitle"]);
			$manager->appendChild($titlee);
			$Fulln=$xml->createElement("Full_name", $row["Full_name"]);
			$manager->appendChild($Fulln);
			$Address=$xml->createElement("P_Address", $row["P_Address"]);
			$manager->appendChild($Address);
			$Pmail=$xml->createElement("P_Email", $row["P_Email"]);
			$manager->appendChild($Pmail);
			$tel=$xml->createElement("Tel_No", $row["Tel_No"]);
			$manager->appendChild($tel);
			$about=$xml->createElement("About_company_project_manager", $row["About_Company_Project_manager"]);
			$manager->appendChild($about);
			$det=$xml->createElement("Details", $row["Details"]);
			$manager->appendChild($det);
		}
		
		//Creating element for department Mobile 
		while($row = mysqli_fetch_array($result_depart1)){
			$depart_name=$xml->createElement("Depart_name");
			$itComp->appendChild($depart_name);
			
			
			$depp=$xml->createElement("Depart");
			$depp->setAttribute("id",$row["id"]);
			$depart_name->appendChild($depp);
			
			$Dname=$xml->createElement("DN", $row["DN"]);
			$depp->appendChild($Dname);
			$room=$xml->createElement("Room_no", $row["Room_no"]);
			$depp->appendChild($room);
			$Eno=$xml->createElement("Employee", $row["Employee"]);
			$depp->appendChild($Eno);
			$Epos=$xml->createElement("Employee_Position", $row["Employee_Position"]);
			$depp->appendChild($Epos);
			$lead=$xml->createElement("Team_leader", $row["Team_leader"]);
			$depp->appendChild($lead);
			$proo=$xml->createElement("Project_done");
			$proo->setAttribute("pdid", "P5");
			$depp->appendChild($proo);
			$proje=$xml->createElement("Project_i", $row["Projecti"]);
			$proo->appendChild($proje);
			$proj=$xml->createElement("Project_ii", $row["Projectii"]);
			$proo->appendChild($proj);
		}
		
		//Creating element for department Web
		while($row = mysqli_fetch_array($result_depart2)){
			$depart_name=$xml->createElement("Depart_name");
			$itComp->appendChild($depart_name);
			
			$depp=$xml->createElement("Depart");
			$depp->setAttribute("id",$row["id"]);
			$depart_name->appendChild($depp);
			
			$Dname=$xml->createElement("DN", $row["DN"]);
			$depp->appendChild($Dname);
			$room=$xml->createElement("Room_no", $row["Room_no"]);
			$depp->appendChild($room);
			$Eno=$xml->createElement("Employee", $row["Employee"]);
			$depp->appendChild($Eno);
			$Epos=$xml->createElement("Employee_Position", $row["Employee_Position"]);
			$depp->appendChild($Epos);
			$lead=$xml->createElement("Team_leader", $row["Team_leader"]);
			$depp->appendChild($lead);
			$proo=$xml->createElement("Project_done");
			$proo->setAttribute("pdid", "P65");
			$depp->appendChild($proo);
			$proje=$xml->createElement("Project_i", $row["Projecti"]);
			$proo->appendChild($proje);
			$proj=$xml->createElement("Project_ii", $row["Projectii"]);
			$proo->appendChild($proj);
			$partner=$xml->createElement("Partner", $row["Partner"]);
			$depp->appendChild($partner);
		}
		
		//Creating element for Team leader
		while($row = mysqli_fetch_array($result_leader1)){
			$leader=$xml->createElement("Team_lead");
			$leader->setAttribute("id", "EMP12");
			$itComp->appendChild($leader);
			
			$DNAME=$xml->createElement("TD", $row["TD"]);
			$leader->appendChild($DNAME);
			$EName=$xml->createElement("EName", $row["EName"]);
			$EName->setAttribute("title", "Mr.");
			$leader->appendChild($EName);
			$EAdd=$xml->createElement("EAddress", $row["EAddress"]);
			$leader->appendChild($EAdd);
			$E_mail=$xml->createElement("Eemail", $row["Eemail"]);
			$leader->appendChild($E_mail);
			$Ephone=$xml->createElement("EPhone", $row["EPhone"]);
			$leader->appendChild($Ephone);
			$Joined=$xml->createElement("Joined_From", $row["Joined_From"]);
			$leader->appendChild($Joined);
			$projedone=$xml->createElement("No_of_Projectsdone", $row["No_of_projectsdone"]);
			$leader->appendChild($projedone);
			$ConEmp=$xml->createElement("No_of_ControllingEmployees", $row["No_of_ControllingEmployees"]);
			$leader->appendChild($ConEmp);
			$Wunder=$xml->createElement("Working_under", $row["Working_under"]);
			$leader->appendChild($Wunder);
		}
		
		//Creating element for Team leader
		while($row = mysqli_fetch_array($result_leader2)){
			$leader=$xml->createElement("Team_lead");
			$leader->setAttribute("id", "EMP15");
			$itComp->appendChild($leader);
			
			$DNAME=$xml->createElement("TD", $row["TD"]);
			$leader->appendChild($DNAME);
			$EName=$xml->createElement("EName", $row["EName"]);
			$EName->setAttribute("title", "Mrs.");
			$leader->appendChild($EName);
			$EAdd=$xml->createElement("EAddress", $row["EAddress"]);
			$leader->appendChild($EAdd);
			$E_mail=$xml->createElement("Eemail", $row["Eemail"]);
			$leader->appendChild($E_mail);
			$Ephone=$xml->createElement("EPhone", $row["EPhone"]);
			$leader->appendChild($Ephone);
			$projedone=$xml->createElement("No_of_Projectsdone", $row["No_of_projectsdone"]);
			$leader->appendChild($projedone);
			$ConEmp=$xml->createElement("No_of_ControllingEmployees", $row["No_of_ControllingEmployees"]);
			$leader->appendChild($ConEmp);
			$Wunder=$xml->createElement("Working_under", $row["Working_under"]);
			$leader->appendChild($Wunder);
		}
		
		$footer=$xml->createElement("Footer");
	    $itComp->appendChild($footer);
		$find=$xml->createElement("find", "Find us on");
		$footer->appendChild($find);
		$map=$xml->createElement("Map");
		$footer->appendChild($map);
		$fb=$xml->createElement("FB");
		$footer->appendChild($fb);
		$link=$xml->createElement("Linkdin");
		$footer->appendChild($link);
		$twitt=$xml->createElement("Twitter");
		$footer->appendChild($twitt);
		$google=$xml->createElement("Google");
		$footer->appendChild($google);
		$cr=$xml->createElement("Copyright", "@copyright 2019");
		$footer->appendChild($cr);
		$note=$xml->createElement("Note", "We work with client all over. Get in touch with us!");
		$footer->appendChild($note);
		
		
		echo "<xmp>".$xml->saveXml()."</xmp>";
		//SAVE XML as a file
		$xml->save ('catalog_17030965.xml');
	}
?>
	
	