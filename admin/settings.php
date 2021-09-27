<?php
global $wpdb;
$table = $wpdb->prefix . 'igwsc88';

$sqlInitialWSDL = 'SELECT * FROM ' . $table . ' WHERE `name` = \'initialWDSL\'';
$initialWSDL = $wpdb->get_results($sqlInitialWSDL);
$sqlWDSLUsername = 'SELECT * FROM ' . $table . ' WHERE `name` = \'wdslUsername\'';
$WDSLUsername = $wpdb->get_results($sqlWDSLUsername);
$sqlWDSLPassword = 'SELECT * FROM ' . $table . ' WHERE `name` = \'wdslPassword\'';
$WDSLPassword = $wpdb->get_results($sqlWDSLPassword);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="wp-heading-inline">Grupo Igal - consume webservice for Cadena88</h1>
        </div>
    </div>
    <hr />
    <div class="wpbody">
        <div clss="wpbody-content">
            <div class="wrap">
                <div class="col-12">
                    <h3>Settings here !!!</h3>
                    <br>
                    <table>
                        <form name="setting" method="post" action="">
                            <tr>
                                <div class="form-group">
                                    <td><label for="initialWDSL">Initial WSDL</label></td>
                                    <td><input type="text" class="form-control" name="initialWDSL" id="initialWDSL" size="80" value="<?php if(isset($_POST['initialWDSL'])) {echo $_POST['initialWDSL'];} else { {echo $initialWSDL[0]->description;}} ?>" required></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="wdslUsername">Username </label></td>
                                    <td><input type="text" class="form-control" name="wdslUsername" id="wdslUsername" value="<?php if (isset($_POST['wdslUsername'])) {echo $_POST['wdslUsername'];} else { {echo $WDSLUsername[0]->description;}} ?>" required></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="wdslPassword">Password </label></td>
                                    <td><input type="password" class="form-control" name="wdslPassword" id="wdslPassword" value="<?php if (isset($_POST['wdslPassword'])) {echo $_POST['wdslPassword'];} else { {echo $WDSLPassword[0]->description;}} ?>" required></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><input type="submit" id="test" name="test" value="Probar conexión"></td>
                                    <td><input type="submit" id="submit" name="submit" value="Submit"></td>                                
                                </div>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit"])) {
    if (($_POST["initialWDSL"] != "") && ($_POST["wdslUsername"] != "") && ($_POST["wdslPassword"] != "")) {
        if ($initialWSDL[0]->id) {
            $update = $wpdb->update($table, ['description' => $_POST['initialWDSL']], ['id' => $initialWSDL[0]->id]);
        } else {
            $update = $wpdb->insert($table, ['name' => 'initialWDSL', 'description' => $_POST['initialWDSL']]);
        }
        if ($WDSLUsername[0]->id) {
            $update = $wpdb->update($table, ['description' => $_POST['wdslUsername']], ['id' => $WDSLUsername[0]->id]);
        } else {
            $update = $wpdb->insert($table, ['name' => 'wdslUsername', 'description' => $_POST['wdslUsername']]);
        }
        if ($WDSLPassword[0]->id) {
            $update = $wpdb->update($table, ['description' => $_POST['wdslPassword']], ['id' => $WDSLPassword[0]->id]);
        } else {
            $update = $wpdb->insert($table, ['name' => 'wdslPassword', 'description' => $_POST['wdslPassword']]);
        }
    } else {
        echo "Incomplete Form";
    }
}

if(isset($_POST["test"])){

    $options = array(
        'login' => "28636",
        'password' => "ZSMW6H",
        'trace' => true
   );

    $url = "https://intranet.cadena88.com/integracion/ws_cadena88.php?wsdl";
    try {
     $client = new SoapClient($url, $options );
     var_dump($client);
     echo "-----------<br>";
     $result = $client->__getFunctions();
     var_dump($result);

     //$result = $client->ResolveIP( [ "ipAddress" => "200.44.32.12", "licenseKey" => "0" ] );
     //print_r($result);
    } catch ( SoapFault $e ) {
     echo $e->getMessage();
    } 


   /*
    $wsdl   = 'https://intranet.cadena88.com/integracion/ws_cadena88.php?wsdl';
    $client = new SoapClient($wsdl, array('trace'=>1));  // The trace param will show you errors
    
    $input_celsius = 36;
    // web service input param
    $request_param = array(
        'Celsius' => $input_celsius
    );
    
    try {
        $responce_param = $client->CelsiusToFahrenheit($request_param);
        echo $input_celsius . ' Celsius => ' . $responce_param->CelsiusToFahrenheitResult . ' Fahrenheit';
    } catch (Exception $e) { 
        echo "<h2>Exception Error</h2>"; 
        echo $e->getMessage(); 
    }


/*
$wsdl = 'https://intranet.cadena88.com/integracion/ws_cadena88.php?wsdl';
$clientOptions = array('login' => '28636', 'password' => 'ZSMW6H');

$username='28636';
$password='ZSMW6H';
$URL='https://intranet.cadena88.com/integracion/ws_cadena88.php?wsdl';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$URL);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
$result=curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
curl_close ($ch);

var_dump($status_code);
*/

    
    //$client = new SoapClient($wsdl, $clientOptions);

    if (($_POST["initialWDSL"] != "") && ($_POST["wdslUsername"] != "") && ($_POST["wdslPassword"] != "")) {
       
        //print_r($this->testWS());
    }


}
?>