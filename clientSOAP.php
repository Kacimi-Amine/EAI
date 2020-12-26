<?php
$mt = 0;
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == "OK") {
        $mt = $_POST['montant'];
        $client = new SoapClient("http://localhost:8686/BanqueWS?wsdl");
        $param = new stdClass();
        $param->montant = $mt;
        $rep = $client->__soapCall("conversionEuroToDh", array($param));
        $res = $rep->return;
    } elseif ($action == "listComptes") {
        $client = new SoapClient("http://localhost:8686/BanqueWS?wsdl");
        $res2 = $client->__soapCall("listComptes", array());
    }
}
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <div class="container" > <br><br><br>
            <form action="clientSOAP.php" method = "post">
                Montant : <br><br>
                <input type="text" name ="montant" class="form-control" value="<?php echo ($mt) ?>"> <br>
                <input type="submit" class="btn btn-primary" value="OK" name="action">
                <input type="submit" class="btn btn-success" value="listComptes" name="action">
            </form><br>
            Resultat :
            <?php if (isset($res)) {?>
                <span class="btn btn-danger">
                <?php echo $res; ?>
                </span>
            <?php }?>

            <?php if (isset($res2)) {?> <br><br>
                <table class="table table-hover">
                    <tr>
                        <th scope="col">CODE</th>
                        <th scope="col">SOLDE</th>
                    </tr>
                <?php foreach ($res2->return as $cp) {?>
                    <tr>
                        <td> <?php echo $cp->code ?> </td>
                        <td> <?php echo $cp->solde ?> </td>
                    </tr>
                <?php }?>
                </table>
            <?php }?>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>

