<?php
function imageUpload($image,$directory,$imageName)
{
      
      // $imageName = $image->getClientOriginalName();
      $image->move($directory,$imageName);
      return $directory.$imageName;
}