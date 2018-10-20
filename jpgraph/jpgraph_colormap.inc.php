<? Php
// ================================================ =======================
// Archivo: JPGRAPH_COLORMAP.INC.PHP
// Descripción: Clase de manejar el uso de mapas de colores. Esto se utiliza para
// Asignar un número a la gama especificada [min, max] y traducir
// Esto a un color en el mapa de color elegido
//
// Creado: 2009-07-10
// Ver: $ Id: 1587 jpgraph_colormap.inc.php 2009-07-14 00: 29: 27Z $ ljp
//
// Derechos de autor (c) Aditus Consulting. Todos los derechos reservados.
//
// Algunos mapas de colores inspirados en la página de la investigación "ColorBrewer".
// Ver: http://www.personal.psu.edu/cab38/ColorBrewer/ColorBrewer.html * /
//
// ================================================ ========================
clase  ColorMap {
    const  EPSILON  =  1.0E-8 ;
    privada  $ rgb  =  nula ;
    privada  $ IMAP  =  0 ;
    privada  $ Irange  =  array ( 0 , 0 ), $ irange_dist  =  0 ;
    privadas  $ iNumColors  =  64 ;
    privada  $ inullcolor  =  ' gris ' ;
    privada  $ isinit  =  false ;
    privadas  $ icolor_buckets  =  array ();
    privadas  $ ipredefmaps  =  array (
    	/ * * Los colores estándar /
        / * * CALOR /
        0  =>  array ( ' negro ' , ' rojo oscuro ' , ' naranja ' , ' amarilla ' , ' blanco ' ),
        / * * BW /
        1  =>  array ( ' negro ' , ' gris ' , ' blanco ' ),
        / * * ARCO IRIS /
        2  =>  array ( ' rojo oscuro ' , ' rojo ' , ' naranja ' , ' amarilla ' , ' verde ' , ' azul ' , ' azul oscuro ' , ' Indigo ' , ' violeta ' ),
        / * * BLUERED1 /
        3  =>  array ( ' navy ' , ' azul ' , ' negro ' , ' rojo ' , ' rojo oscuro ' ),
        / * * BLUERED2 /
        4  =>  array ( ' navy ' , ' azul ' , ' amarilla ' , ' rojo ' , ' rojo oscuro ' ),
        / * * GREENRED1 /
        5  =>  array ( ' verde oscuro ' , ' verde ' , ' negro ' , ' rojo ' , ' rojo oscuro ' ),
        / * * GREENRED2 /
        6  =>  array ( ' verde oscuro ' , ' verde ' , ' amarilla ' , ' rojo ' , ' rojo oscuro ' ),
        / * * GREENBLUE1 /
        7  =>  array ( ' azul oscuro ' , ' azul ' , ' negro ' , ' verde ' , ' verde oscuro ' ),
        / * * GREENBLUE2 /
        8  =>  array ( ' azul oscuro ' , ' azul ' , ' amarilla ' , ' verde ' , ' verde oscuro ' ),
	    / * * Bluegreenred /
        9  =>  array ( ' azul ' , ' verde oscuro ' , ' verde ' , ' rojo ' , ' rojo oscuro ' ),
        / * Mapas de color inspirados en la página de investigación "ColorBrewer". * /
        / * Véase: http://www.personal.psu.edu/cab38/ColorBrewer/ColorBrewer.html * /
        / * * Centro de colores blanco /
        10  =>  array ( ' #b35806 ' , ' #e08214 ' , ' #fdb863 ' , ' #fee0b6 ' , ' #f7f7f7 ' , ' #d8daeb ' , ' #b2abd2 ' , ' #8073ac ' , ' #542788 ' ),
        11  =>  array ( ' #8c510a ' , ' #bf812d ' , ' #dfc27d ' , ' #f6e8c3 ' , ' #f5f5f5 ' , ' #c7eae5 ' , ' #80cdc1 ' , ' #35978f ' , ' #01665e ' ),
        12  =>  array ( ' #b2182b ' , ' #d6604d ' , ' #f4a582 ' , ' #fddbc7 ' , ' #f7f7f7 ' , ' #d1e5f0 ' , ' #92c5de ' , ' #4393c3 ' , ' #2166ac ' ),
        13  =>  array ( ' #b2182b ' , ' #d6604d ' , ' #f4a582 ' , ' #fddbc7 ' , ' #ffffff ' , ' #e0e0e0 ' , ' #bababa ' , ' #878787 ' , ' #4d4d4d ' ),
		14  =>  array ( ' #d73027 ' , ' #f46d43 ' , ' #fdae61 ' , ' #fee08b ' , ' #ffffdf ' , ' #d9ef8b ' , ' #a6d96a ' , ' #66bd63 ' , ' #1a9850 ' ),
		/ * Secuencial * /
		15  =>  array ( ' #fff7fb ' , ' #ece7f2 ' , ' #d0d1e6 ' , ' #a6bddb ' , ' #74a9cf ' , ' #3690c0 ' , ' #0570b0 ' , ' #045a8d ' , ' #023858 ' ),
		16  =>  array ( ' #f7fcfd ' , ' #e5f5f9 ' , ' #ccece6 ' , ' #99d8c9 ' , ' #66c2a4 ' , ' #41ae76 ' , ' #238b45 ' , ' #006d2c ' , ' #00441b ' ),
		17  =>  array ( ' #ffffd9 ' , ' #edf8b0 ' , ' #c7e9b4 ' , ' #7fcdbb ' , ' #41b6c3 ' , ' #1d91c0 ' , ' #225ea8 ' , ' #253494 ' , ' #081d58 ' ),
		18  =>  array ( ' #fff7ec ' , ' #fee8c8 ' , ' #fdd49e ' , ' #fdbb84 ' , ' #fc8d59 ' , ' #ef6548 ' , ' #d7301f ' , ' #b30000 ' , ' #7f0000 ' ),
		19  =>  array ( ' #ffffcc ' , ' #ffeda0 ' , ' #fed976 ' , ' #feb24c ' , ' #fd8d3c ' , ' #fc4e2a ' , ' #e31a1c ' , ' #bd0026 ' , ' #b00026 ' ),
		20  =>  array ( ' #ffffe5 ' , ' #fff7bc ' , ' #fee391 ' , ' #fec44f ' , ' #fe9929 ' , ' #ec7014 ' , ' #cc4c02 ' , ' #993404 ' , ' #662506 ' ),
		21  =>  array ( ' # f7fcfd ' , ' # e0ecf4 ' , ' # bfd3e6 ' , ' # 9ebcda ' , ' # 8c96c6 ' , ' # 8c6bb1 ' , ' # 88419d ' , ' # 810f7c ' , ' # 4d004b ' )
    );
    privada  $ icurrmap  =  array (), $ icurrmap_num  =  - 1 ;
    pública  función  __construct () {
        $ this -> setMap ( 0 );
        $ this -> SetNumColors ( 64 );
    }
    pública  función  InitRGB ( $ argb ) {
        $ this -> RGB  =  $ argb ;        
    }
    
    pública  función  setMap ( $ AMAP , $ aInvert = false ) {
        
        si ( is_array ( $ AMAP )) {
            // Supongamos que es un mapa de color especificada manualmente
            si ( $ aInvert ) {
                $ this -> icurrmap  =  array_reverse ( $ AMAP );
            }
            otra cosa {
                $ this -> icurrmap  =  $ AMAP ;
                $ this -> IMAP  =  - 1 ; // Marcos que este es un mapa personalizado
            }            
        }
        otra cosa {
            $ this -> IMAP  =  $ AMAP ;
            $ n  =  count ( $ this -> ipredefmaps ) - 1 ;
            si ( $ AMAP  >  $ n ) {
        	    JpGraphError :: RaiseL ( 29205 , $ n );
        	    // 'Especificación de mapa de colores fuera de gama. Debe ser un entero en [,% d 0] 'gama
            }
            si ( $ aInvert ) {
        	    $ this -> icurrmap  =  array_reverse ( $ this -> ipredefmaps [ $ this -> IMAP ]);
            }
            otra cosa {
        	    $ this -> icurrmap  =  $ this -> ipredefmaps [ $ this -> IMAP ];
            }
        }
        $ this -> icurrmap_num  =  count ( $ this -> icurrmap );
        $ this -> isinit  =  false ;
    }
    
    pública  función  GetCurrMap () {
    	volver  matriz ( $ this -> IMAP , $ this -> icurrmap );
    }
    
    pública  función  SetRange ( $ Amin , $ Amax ) {
        si ( $ Amin  >  $ Amax ) {
            JpGraphError :: RaiseL ( 29201 );
            // 'Valor de rango mínimo debe ser menor o igual al valor del rango máximo de mapas de colores'
        }
        $ this -> Irange [ 0 ] =  $ Amin ;
        $ this -> Irange [ 1 ] =  $ Amax ;
        $ this -> irange_dist  =  $ Amax  -  $ Amin ;
        si ( $ this -> irange_dist  <=  ColorMap :: EPSILON ) {
            JpGraphError :: RaiseL ( 29202 );
            // "La distancia entre min y max valor es demasiado pequeño para la precisión numérica '
        }
    }
    
    pública  función  GetRange () {
        devolver  $ this -> Irange ;
    }
    
    pública  de función  SetNumColors ( $ anum , $ AAjuste = true ) {
        $ p  =  $ this -> icurrmap_num ;
        si ( $ AAjuste ) {
        	$ anum  =  round (( $ anum - $ p ) / ( $ p - 1 )) * ( $ p - 1 ) +  $ p ;
        }
        $ this -> iNumColors  =  $ anum ;
        $ this -> isinit  =  false ;
        devolver  $ anum ;
    }
    
    pública  función  SetNullColor ( $ aNullColor ) {
        $ this -> inullcolor  =  $ aNullColor ;
    }
    
    privada  función  chk () {
        si ( ! $ this -> isinit )
            $ this -> InitBuckets ();
    }
    
    pública  función  getColor ( $ Aval ) {
        $ this -> chk ();
    	si ( is_nan ( $ Aval ) ||  is_null ( $ Aval )) {
    		devolver  $ this -> inullcolor ;
    	}
        si ( $ Aval  <=  $ this -> Irange [ 0 ]) {
            devolver  $ this -> icolor_buckets [ 0 ];
        }
        si ( $ Aval  > =  $ this -> Irange [ 1 ]) {
            devolver  $ this -> icolor_buckets [ $ this -> iNumColors - 1 ];
        }
        // Valor de escala
        $ x  = ( $ Aval  -  $ this -> Irange [ 0 ]) /  $ this -> irange_dist ;
        $ paquete  =  baja ( $ x  * ( $ this -> iNumColors - 1 ));
        devolver  $ this -> icolor_buckets [ $ balde ];
    }
    
    pública  de función  GetBuckets () {
		$ this -> chk ();
        devolver  $ this -> icolor_buckets ;
    }
    
    privada  función  del labio ( $ aTecla , $ AEND , $ Aval ) {
       // Método de interpolación lineal ayudante
       si ( $ aTecla  ==   $ AEND )
            devolver  $ aTecla ;
        otra cosa {
            // $ X = ($ Aval - $ aTecla) / ($ AEND - aTecla $);
            retorno  $ aTecla  +  $ Aval * (( $ AEND  -  $ aTecla ));
        }
    }
    privada  de función  InitBuckets () {
    	// En primer lugar hacer algunas comprobaciones ya que el número de cubos
    	// Es en cierta medida controlada por el número de platoes en
    	// El mapa de color. Por ejemplo. Si el mapa como tres colores platoe
    	// El el número posible de cubos son: 3,5,7, 9, ...
    	// Si el número de platoes colores 4 la n la posible
    	// Número de cubos son: 4, 7, 10, 13, ..
    	// En resumen el número de cubetas son p + k * (n-1), k = 0, 1, 2, ..
    	si ( $ this -> iNumColors  <  $ this -> icurrmap_num ) {
			JpGraphError :: RaiseL ( 29203 , $ this -> icurrmap_num );
			// 'Número de nivel de color cuantificación debe ser al menos', $ this-> icurrmap_num
    	}
    	si (( $ this -> iNumColors - $ this -> icurrmap_num ) % ( $ this -> icurrmap_num - 1 ) ! ==  0 ) {
    		JpGraphError :: RaiseL ( 29204 , $ this -> iNumColors , $ this -> icurrmap_num , $ this -> icurrmap_num - 1 );
    		// 'Número de colores (% d) no es válido para este mapa de colores. ITM debe haber un número que puede ser escrito como:% d + k *% d '
    	}
        
        // Recuerde que el mapa se ha inicializado
        $ this -> isinit  =  verdadero ;
        
        // Primero averiguar cuántas valor que necesitamos para crear entre
        // los valores Platou color dado
        $ n  = ( $ this -> iNumColors  -  $ this -> icurrmap_num ) / ( $ this -> icurrmap_num  -  1 ) +  1 ;
        // Ahora bucle a través de todos los colores dados y crear
        // cubos interpolando el valor entre dos
        // colores consecutivos en el mapa
        // El índice i se refiere al color más baja
        $ k  =  0 ;
        $ etapa  =  1 / $ n ;
        de ( $ i = 0 ; $ i  <  $ this -> icurrmap_num - 1 ; ++ $ i ) {
            $ RGB1  =  $ this -> RGB -> Color ( $ this -> icurrmap [ $ i ]);
            $ RGB2  =  $ this -> RGB -> Color ( $ this -> icurrmap [ $ i + 1 ]);
            $ v  =  0 ;
            de ( $ j = 0 ; $ j  <  $ n ; ++ $ j ) {
                $ r  =  round ( $ this -> labio ( $ RGB1 [ 0 ], $ RGB2 [ 0 ], $ v ));
                $ g  =  round ( $ this -> labio ( $ RGB1 [ 1 ], $ RGB2 [ 1 ], $ v ));
                $ b  =  round ( $ this -> labio ( $ RGB1 [ 2 ], $ RGB2 [ 2 ], $ v ));
                $ this -> icolor_buckets [ $ k ++ ] =  array ( $ r , $ g , $ b );
                $ v  + =  $ etapa ;
            }
        }
        // Establecer el último segmento para el último color platoen        
        $ this -> icolor_buckets [ $ k ] =  $ RGB2 ;
    }
}
? >