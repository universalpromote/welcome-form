<?php
// Fetching Values from URL.
$name = $_POST['username'];
$title = $_POST['usertitle'];
$phone = $_POST['userphone'];
$email = $_POST['useremail'];
$price = $_POST['listprice'];
$street = $_POST['liststreet'];
$city = $_POST['listcity'];
$bedrooms = $_POST['listbeds'];
$baths = $_POST['listbaths'];
$squareft = $_POST['listsqft'];
$lotsize = $_POST['listlot'];
$listingtype = $_POST['listtype'];
$yrbuilt = $_POST['listyrblt'];
$listdesc = $_POST['listdesc'];

$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing E-mail.
// After sanitization Validation is performed
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
if (!preg_match("/^[0-9]{10}$/", $phone)) {
echo "<span>* Please Fill Valid Contact No. *</span>";
} else {
$subject = $name;
// To send HTML mail, the Content-type header must be set.
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: multipart/form-data; charset=UTF-8' . "\r\n";
$headers .= 'From:' . $email. "\r\n"; // Sender's Email
$headers .= 'Cc:' . $email. "\r\n"; // Carbon copy to Sender
$template = '<div style="padding:50px; color:white;">Hello ' . $name . ',<br/>'
. '<br/>Thank you...! For Contacting Us.<br/><br/>'
. 'Name:' . $name . '<br/>'
. 'Title:' . $title . '<br/>'
. 'Email:' . $email . '<br/>'
. 'Contact No:' . $phone . '<br/>'
. 'Price:' . $price . '<br/><br/>'
. 'Street:' . $street . '<br/><br/>'
. 'City:' . $city . '<br/><br/>'
. 'Bedrooms:' . $bedrooms . '<br/><br/>'
. 'Baths:' . $baths . '<br/><br/>'
. 'Square Foot:' . $squareft . '<br/><br/>'
. 'Lot Size:' . $lotsize . '<br/><br/>'
. 'Type:' . $listingtype . '<br/><br/>'
. 'Year Built:' . $yrbuilt . '<br/><br/>'
. 'Description:' . $listdesc . '<br/><br/>'
. 'This is a Contact Confirmation mail.'
. '<br/>'
. 'We Will contact You as soon as possible .</div>';
$sendmessage = "<div style=\"background-color:#7E7E7E; color:white;\">" . $template . "</div>";
// Message lines should not exceed 70 characters (PHP rule), so wrap it.
$sendmessage = wordwrap($sendmessage, 70);
// Send mail by PHP Mail Function.
mail("hassansalman8@gmail.com", $subject, $sendmessage, $headers);
echo "Your Query has been received, We will contact you soon.";
}
} else {
echo "<span>* invalid email *</span>";
}
?>