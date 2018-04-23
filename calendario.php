<?php  
include_once("includes/templates/header.php"); ?>

        

        <section class="seccion contenedor">
           <h2>Calendario</h2>

                <?php
                    try{
                       require_once("includes/funciones/bd_conexion.php");
                        $sql="Select evento_id, nombre,fecha_evento,hora_evento,cat_evento,nombre_invitado,apellido_invitado  from eventos
                            INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria
                            INNER JOIN invitados ON eventos.id_inv = invitados.invitado_id ORDER BY evento_id"; 
                        $resultado=$conexion->query($sql);

                    } catch(exception $e){
                        echo $e->getMessage();    

                    }
                ?>

                <div class="calendario clearfix">
                   <!-- <table border=1 align=center>
                      <thead>
                        <tr> 
                            <th>ID</th> 
                            <th>NOMBRE</th>
                            <th>FECHA</th>
                            <th>HORA</th> 
                            <th>Categoria</th>
                            <th>Invitado</th>
                             
                        </tr>
                      </thead> 
                      <tbody>  -->  
                    <?php
                    $calendario=array();
                   while($eventos=$resultado->fetch_assoc()){?>

                    <?php ?>
                    
                    <?php
                    //obtiene la fecha del evento
                     
                    $fecha =$eventos['fecha_evento'];

                      $evento=array(
                          "id" =>  $eventos['evento_id'],
                          "nombre" => $eventos['nombre'],
                          "fecha"=>$eventos['fecha_evento'],
                          "hora"=>$eventos['hora_evento'],
                          "categoria"=>$eventos['cat_evento'],
                          "invitado"=>$eventos['nombre_invitado'] . $eventos['apellido_invitado']
                      );

                   /* echo "<tr>
                          <td>$eventos[evento_id]</td> 
                          <td>$eventos[nombre]</td>
                          <td>$eventos[fecha_evento]</td>
                          <td>$eventos[hora_evento]</td> 
                          <td>$eventos[cat_evento]</td>
                          <td>$eventos[nombre_invitado] $eventos[apellido_invitado]</td> 
                          <tr>";   
                      */    

                      $calendario[$fecha][]=$evento;
                      
                   }
                    ?>
                    <?php 
                      //imprimimos todos los arreglos
                      foreach($calendario as $dia =>$lista_eventos){?>
                        <h3>
                            <i class="fa fa-calendar"></i>
                            
                            <?php
                            //para cambiar formato a las fechas 
                            //setlocale(LC_TIME,'es_ES.UTF-8');//UNIX
                            setlocale(LC_TIME,'spanish');//windows

                            echo strftime("%A,%d de %B del %Y",strtotime($dia)); 
                            
                            ?>
                        </h3>

                        <?php foreach($lista_eventos as $evento){?>
                            <div class="dia">
                              <p class="titulo"> <?php echo $evento['nombre'];?> </p>
                              <p class="hora"><i class="fas fa-calendar-alt" aria-hidden="true"></i>
                                  <?php echo $evento['fecha']." " . $evento['hora'];    ?>                             
                              </p>
                              <p><?php echo $evento['categoria']; ?> </p>
                              <p>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <?php echo $evento['invitado']; ?> 
                              </p>
                            </div>
                        
                         <?php } //fin foreach eventos ?>
                    <?php } //fin foreach dias ?>
                    
                     </tbody>
                   </table>     
                    
                </div>

                <?php
                 $conexion->close();
                
                ?>

        </section>

           <?php include_once("includes/templates/footer.php"); ?>