<?php 
if (isset($_GET['id_cliente'])) {
    include "clase_carrito.php";
    $carro = new carrito();
    $id_cliente = $_GET['id_cliente'];
   
   }
   ?>
   <div align="center">
    <form action="" method="POST" id="pay" name="pay" >
        <table width="50%">
         <tr>
            <td>
                <div>

                </div>
            </td>
            <td>
                <div align="center">
                    <select name="" id="" class="form-control">
                        <option value="MasterCard">MasterCard</option>
                        <option value="Visa">Visa</option>
                        <option value="AmericanExpress">AmericanExpress</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div>

                </div>
            </td>
            <td>
                <div align="center">
                    <input type="text" class="form-control" minlength="10" maxlength="16" placeholder="Número de tarjeta" name="tarjeta" id="tarjeta" onchange="comprobar_tarjeta()">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div>

                </div>
            </td>
            <td>
                <div align="center">
                    <input type="number" class="form-control" min="1" max="12" placeholder="MM" style="width: 30%; display: inline-block;">
                    <input type="number" class="form-control" min="2019" max="2044" placeholder="YY" style="width: 30%;display: inline-block;">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div>

                </div>
            </td>
            <td>
                <div align="center">
                    <input type="text" class="form-control" minlength="3" maxlength="3" placeholder="Código de seguridad">
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" class="form-control" style="width: 40%" value="COMPRAR" name="comprar">
                </div>
            </td>
        </tr>
        <?php 
            if(isset($_POST['comprar'])){
                $tarjeta = $_POST['tarjeta'];
                $odd = true;
                $sum = 0;
                foreach ( array_reverse(str_split($tarjeta)) as $num) {
                     $sum += array_sum( str_split(($odd = !$odd) ? $num*2 : $num) );
                }
                if(($sum % 10 == 0) && ($sum != 0)){
                    alert("GRACIAS POR SU COMPRA");
                    $id_cliente = $_SESSION['id'];
                    $carro->Save_data_client($id_cliente);
                    alert("COMPRA EXITOSA");
                    ?>
                     <tr>
                        <td colspan="2">
                            <div align="center">
                                <a href="modulos/pdf_recibo.php">
                                    <button name="pdf" class="form-control" type="button" style="width: 30%">RECIBO</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                   // nueva_pestaña("pdf_recibo");
                    //redit("?p=inicio");
                    
                }else{
                    alert("NUMEROO");
                }
         ?>
       
    </table>
</form>
</div>
   <?php
}
?>
