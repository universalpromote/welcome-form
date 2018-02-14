<?php

// Email address verification
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if($_POST) {

    // Enter the email where you want to receive the message
    $emailTo = 'hassansalman8@gmail.com';
    $Subject = 'Universal Promote Form Message';

    $clientName = addslashes(trim($_POST['agent_name']));
    $clientTitle = addslashes(trim($_POST['agent_title']));
    $clientPhone = addslashes(trim($_POST['agent_phone']));
    $clientEmail = addslashes(trim($_POST['agent_email']));
    $clientPrice = addslashes(trim($_POST['listing_price']));
    $clientStreet = addslashes(trim($_POST['listing_street']));
    $clientCity = addslashes(trim($_POST['listing_city']));
    $clientBeds = addslashes(trim($_POST['beds_total']));
    $clientBaths = addslashes(trim($_POST['baths_total']));
    $clientSqft = addslashes(trim($_POST['sqft_total']));
    $clientLot = addslashes(trim($_POST['lot_total']));
    $clientType = addslashes(trim($_POST['listing_type']));
    $clientYrbuilt = addslashes(trim($_POST['year_built']));
    $clientDesc = addslashes(trim($_POST['listing_description']));

    $array = array('nameMessage' => '', 'titleeMessage' => '', 'phoneMessage' => '', 'emailMessage' => '', 'priceMessage' => '', 'streetMessage' => '', 'cityMessage' => '', 'bedsMessage' => '', 'bathsMessage' => '', 'sqftMessage' => '', 'lotMessage' => '', 'typeMessage' => '', 'yrbuiltMessage' => '', 'descMessage' => '');

    if(!isEmail($clientEmail)) {
        $array['agent_email'] = 'Invalid email!';
    }
		if($clientTitle == '') {
				$array['agent_title'] = 'Empty name!';
		}
    if($clientPhone == '') {
        $array['agent_phone'] = 'Empty phone!';
    }
    if($clientEmail == '') {
        $array['agent_email'] = 'Empty message!';
    }
    if($clientPrice == '') {
        $array['listing_price'] = 'Empty phone!';
    }
    if($clientStreet == '') {
        $array['listing_street'] = 'Empty message!';
    }
    if($clientCity == '') {
        $array['listing_city'] = 'Empty phone!';
    }
    if($clientBeds == '') {
        $array['beds_total'] = 'Empty message!';
    }
    if($clientBaths == '') {
        $array['baths_total'] = 'Empty phone!';
    }
    if($clientSqft == '') {
        $array['sqft_total'] = 'Empty message!';
    }
    if($clientLot == '') {
        $array['lot_total'] = 'Empty phone!';
    }
    if($clientType == '') {
        $array['listing_type'] = 'Empty message!';
    }
    if($clientYrbuilt == '') {
        $array['year_built'] = 'Empty phone!';
    }
    if($clientDesc == '') {
        $array['listing_description'] = 'Empty message!';
    }

    if(isEmail($clientEmail) && $clientName != '' && $clientPhone != '' && $clientDesc != '') {
			// prepare email body text
			$Body = "";
			$Body .= "Name: ";
			$Body .= $clientName;
            $Body .= "\n";
            $Body .= "Title: ";
			$Body .= $clientTitle;
			$Body .= "\n";
			$Body .= "Email: ";
			$Body .= $clientEmail;
			$Body .= "\n";
			$Body .= "Phone: ";
			$Body .= $clientPhone;
            $Body .= "\n";
            $Body .= "Price: ";
			$Body .= $clientPrice;
            $Body .= "\n";
            $Body .= "Street: ";
			$Body .= $clientStreet;
            $Body .= "\n";
            $Body .= "City: ";
			$Body .= $clientCity;
            $Body .= "\n";
            $Body .= "Bedrooms: ";
			$Body .= $clientBeds;
            $Body .= "\n";
            $Body .= "Bathrooms: ";
			$Body .= $clientBaths;
			$Body .= "\n";
            $Body .= "Square Foot: ";
			$Body .= $clientSqft;
            $Body .= "\n";
            $Body .= "Lot: ";
			$Body .= $clientLot;
            $Body .= "\n";
            $Body .= "Type: ";
			$Body .= $clientType;
            $Body .= "\n";
            $Body .= "Year Built: ";
			$Body .= $clientYrbuilt;
            $Body .= "\n";
            $Body .= "Description: ";
			$Body .= $clientDesc;
			$Body .= "\n";
        // Send email
		$headers = "From: " . $clientEmail . " <" . $clientEmail . ">" . "\r\n" . "Reply-To: " . $clientEmail;
		mail($emailTo, $Subject, $Body, $headers);
    }

    echo json_encode($array);

}

?>
