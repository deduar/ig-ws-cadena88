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
                                    <td><input type="text" class="form-control" name="initialWDSL" id="initialWDSL" value="<?php if($_POST['initialWDSL'] != ""){echo $_POST['initialWDSL'];}else{echo $settings['initialWDSL'];} ?>" size="80"></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="wdslUsername">Username </label></td>
                                    <td><input type="text" class="form-control" name="wdslUsername" id="wdslUsername" value="<?php if($_POST['wdslUsername'] != ""){echo $_POST['wdslUsername'];}else{echo $settings['wdslUsername'];} ?>"></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="wdslPassword">Password </label></td>
                                    <td><input type="password" class="form-control" name="wdslPassword" id="wdslPassword" value="<?php if($_POST['wdslPassword'] != ""){echo $_POST['wdslPassword'];}else{echo $settings['wdslPassword'];} ?>"></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><input type="submit" id="submit" name="submit" value="Submit"></td>
                                    <td></td>
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
// Proces the form

if (isset($_POST["submit"])) {
    echo "Process form SUBMIT <br>";
    if(($_POST["initialWDSL"] != "") && ($_POST["wdslUsername"] != "") && ($_POST["wdslPassword"] != "")){
        echo "update reg";
        echo $_POST["initialWDSL"]."<br>";
        echo $_POST["wdslUsername"]."<br>";
        echo $_POST["wdslPassword"]."<br>";
    }else{
        echo "Form incompleto";
    }
}

?>