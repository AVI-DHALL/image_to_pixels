<?php

    $src    = 'test.png';
    $im     = imagecreatefrompng($src);

    $size   = getimagesize($src);
    
	$width  = $size[0];
    echo 'width of the image: '.$width.'<br>';
	$height = $size[1];
	echo 'height of the image: '.$height.'<br><br>';

	
	$count = 0; // variable to count the number of pixels formed.
	
	for($y=0;$y<$height;$y=$y+5)
    {
        for($x=0;$x<$width;$x=$x+5)
        {
					
					$mm = imagecreate(5, 5); // size of the pixel created will be 5*5.
					$rgb = imagecolorat($im, $x, $y);

					$r = ($rgb >> 16) & 0xFF;
					$g = ($rgb >> 8) & 0xFF;
					$b = ($rgb >> 0) & 0xFF;
					
					// rgb to hexadecimal conversion
					$a = sprintf('%02x',$r);
					$bg = sprintf('%02x',$g);
					$c = sprintf('%02x',$b);

					// hexadecimal to decimal conversion
					$red= hexdec($a);
					$green= hexdec($bg);
					$blue= hexdec($c);
			
			
					try{
					$color =imagecolorallocate($mm,$red,$green,$blue);
					imagesetpixel($mm,$x,$y,$color);
					imagejpeg($mm,"./pixels/new".$count.".jpeg",75);
					}
					catch (Exception $e)
					{
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
					$count++;
        }
    }

			
	/*------Uploading Pixels from a folder to the browser and trying to get the original image back from the pixels -----------*/

	$innercount=0;
	$dirname = "./pixels/";
	$images = glob($dirname."*.jpeg", GLOB_NOSORT);

	?>
	<div style= "width: 40px; height: 40px;"> <!-- Pass here the size of the original image. Here, it's 40*40.-->
	<?php
	foreach($images as $image) 
	{
		
		$innercount++;
		echo '<img src="'.$image.'" />';
	}
	?>
	</div>
	<?php
	echo '<br># of pixels formed(saved) in the folder: '.$count;
	echo '<br># of pixels uploaded from the folder to the browser: '.$innercount;
	echo '<br>';

	?>