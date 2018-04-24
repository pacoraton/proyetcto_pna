<?php include_once("includes/templates/header.php"); ?>

        <section class="seccion contenedor">
            <h2> La mejor conferencia de diseño web en español</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </section>

           <section class="programa">
               <div class="contenedor-video">
                   <video autoplay loop poster="img/bg-talleres.jpg">
                       <source src="video/video.mp4" type="video/mp4">
                       <source src="video/video.webm" type="video/webm">
                       <source src="video/video.ogv" type="video/ogg">
                   </video>
               </div><!--.contenedor-video -->
               <div class="contenido-programa">
                   <div class="contenedor">
                       <div class="programa-evento">
                           <h2>Programa del evento</h2>
                           <?php
                           require_once("includes/funciones/bd_conexion.php");
                           $sql=" Select * from categoria_evento";
                           $resultado=$conexion->query($sql);
                           ?>

                           <nav class="menu-programa">
                           <?php while($registros=$resultado->fetch_assoc()){ ?>
                           <?php $tipo_evento=$registros['cat_evento'];  ?>
                         
                               <a href="#<?php echo strtolower($tipo_evento); ?>"><i class="fa <?php echo $registros['icono'] ; ?> " aria-hidden="true"></i><?php echo $tipo_evento; ?></a>
                        
                          <?php  } ?>
                           </nav>

                           <?php
                            try{
                            require_once("includes/funciones/bd_conexion.php");
                                $sql2="Select evento_id, nombre,fecha_evento,hora_evento,cat_evento,nombre_invitado,apellido_invitado  from eventos
                                    INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria
                                    INNER JOIN invitados ON eventos.id_inv = invitados.invitado_id and eventos.id_cat_evento =1 ORDER BY evento_id LIMIT 2;
                                    
                                    Select evento_id, nombre,fecha_evento,hora_evento,cat_evento,nombre_invitado,apellido_invitado  from eventos
                                    INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria
                                    INNER JOIN invitados ON eventos.id_inv = invitados.invitado_id and eventos.id_cat_evento =2 ORDER BY evento_id LIMIT 2;
                                    
                                    Select evento_id, nombre,fecha_evento,hora_evento,cat_evento,nombre_invitado,apellido_invitado  from eventos
                                    INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria
                                    INNER JOIN invitados ON eventos.id_inv = invitados.invitado_id and eventos.id_cat_evento =3 ORDER BY evento_id LIMIT 2;"; 
                  

                            } catch(exception $e){
                                echo $e->getMessage();    

                            }
                ?>
                        <?php $conexion->multi_query($sql2); ?>
                               <?php do {
                                    $resultado2=$conexion->store_result();
                                    $row=$resultado2->fetch_all(MYSQLI_ASSOC); ?>
                                     <?php $i=0;  ?>
                                    <?php foreach($row as $evento): ?>
                                        <?php if($i % 2 ==0) { ?>
                                            <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                                        <?php } ?> 
                                            <div class="detalle-evento">
                                                <h3><?php echo $evento['nombre'] ;?></h3>
                                                <p><i class="far fa-clock" aria-hidden="true"></i><?php echo $evento['hora_evento'] ;?></p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento'] ;?></p>
                                                <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado']." ".$evento['apellido_invitado'] ;?> 
                                            </div>
                                        <?php if($i % 2 ==1): ?>
                                            
                                        <a href="calendario.php" class="button" float-right>Ver todos</a>
                                        </div><!--.talleres -->
                                         <?php endif; ?>
                                        <?php $i++; ?>
                                   
                                        <?php endforeach;
                                        ?>
                                        <?php $resultado2->free(); ?>

                             <?php   } while($conexion->more_results() && $conexion->next_result()); ?>     

                            
                       </div><!--.programa-evento-->
                   </div><!--.contenedor -->
               </div><!--.contenido-programa -->
           </section><!--.programa -->

          <?php include_once("includes/templates/invitados.php"); ?>

           <div class="contador parallax">
	           	<div class="contenedor">
	           		<ul class="resumen-evento clearfix">
	           			<li><p class="numero"></p>Invitados</li>
	           			<li><p class="numero"></p>Talleres</li>
	           			<li><p class="numero"></p>Días</li>
	           			<li><p class="numero"></p>Conferencias</li>
	           		</ul>
	           	</div>
         
           </div>
           <section class="precios seccion">
           	    <h2>Precios</h2>
           	    <div class="contenedor">
           	    	<ul class="lista-precios clearfix">
           	    		<li>
           	    			<div class="tabla-precio">
           	    				<h3>Pase por dia</h3>
           	    				<p class="numero">$30</p>
           	    				<ul>
           	    					<li>Bocadillos Gratis</li>
           	    					<li>Todas las Conferencias</li>
           	    					<li>Todos los Talleres</li>
           	    				</ul>
           	    				<a href="" class="button hollow">Comprar</a>
           	    			</div>
           	    		</li>

           	    		<li>
           	    			<div class="tabla-precio">
           	    				<h3>Todos los dias</h3>
           	    				<p class="numero">$50</p>
           	    				<ul>
           	    					<li>Bocadillos Gratis</li>
           	    					<li>Todas las Conferencias</li>
           	    					<li>Todos los Talleres</li>
           	    				</ul>
           	    				<a href="" class="button ">Comprar</a>
           	    			</div>
           	    		</li>

           	    		<li>
           	    			<div class="tabla-precio">
           	    				<h3>Pase por 2 dias</h3>
           	    				<p class="numero">$45</p>
           	    				<ul>
           	    					<li>Bocadillos Gratis</li>
           	    					<li>Todas las Conferencias</li>
           	    					<li>Todos los Talleres</li>
           	    				</ul>
           	    				<a href="" class="button hollow">Comprar</a>
           	    			</div>
           	    		</li>
           	    	</ul>
           	    </div>
           </section>

           <div id="mapa" class="mapa">
           	

           </div>


           <section class="seccion">
           	   <h2>Testimoniales</h2>
               <div class="testimoniales contenedor clearfix">
	           	   <div class="testimonial ">
	           	   	   <blockquote >
		           	   	   	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quasi, cum, minus nihil possimus vel culpa neque pariatur quidem. Deleniti voluptate, recusandae id assumenda laudantium cum fuga? Quo, hic rerum! </p>
		           	   	   	<footer class="info-testimonial clearfix">
		           	   	   		<img src="img/testimonial.jpg" alt="imagen-testimonial">
		           	   	   		<cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
		           	   	   	</footer>
	           	   	   </blockquote>
	           	   </div><!--.testimonial-->

	               <div class="testimonial">
	           	   	   <blockquote >
		           	   	   	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quasi, cum, minus nihil possimus vel culpa neque pariatur quidem. Deleniti voluptate, recusandae id assumenda laudantium cum fuga? Quo, hic rerum! </p>
		           	   	   	<footer class="info-testimonial clearfix">
		           	   	   		<img src="img/testimonial.jpg" alt="imagen-testimonial">
		           	   	   		<cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
		           	   	   	</footer>
	           	   	   </blockquote>
	           	   </div><!--.testimonial-->


	           	   <div class="testimonial">
	           	   	   <blockquote >
		           	   	   	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quasi, cum, minus nihil possimus vel culpa neque pariatur quidem. Deleniti voluptate, recusandae id assumenda laudantium cum fuga? Quo, hic rerum! </p>
		           	   	   	<footer class="info-testimonial clearfix">
		           	   	   		<img src="img/testimonial.jpg" alt="imagen-testimonial">
		           	   	   		<cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
		           	   	   	</footer>
	           	   	   </blockquote>
	           	   </div><!--.testimonial-->
                </div>
           </section>

           <div class="newsletter parallax">
           	  <div class="contenido contenedor">
           	  	<p>Registrate al newsletter</p>
				<h3>gdlwebcamp</h3>
				<a href="#" class="button transparente">Registro</a>
           	  </div><!--Contenido-->
           </div><!--newsletter-->

           <section class="seccion">
           	  <h2>Faltan</h2>
           	  <div class="cuenta-regresiva">
           	  	<ul class="clearfix contenedor">
           	  		<li><p id="dias" class="numero"></p>dias</li>
           	  		<li><p id="horas" class="numero"></p>horas</li>
           	  		<li><p id="minutos" class="numero"></p>minutos</li>
           	  		<li><p id="segundos" class="numero"></p>segundos</li>
           	  	</ul>
           	  </div>
           </section>

<?php include_once("includes/templates/footer.php"); ?>
          
