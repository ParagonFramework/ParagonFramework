<!-- there should be a generic endpoint where the data from the widgets can be sent to -->
<?php
$ofh->field("status",$this->product->status);
$ofh->field("name",$this->product->name);
$ofh->field("manufacturer",$this->product->manufacturer);
$ofh->field("features",$this->product->features,["label" => "Awesome Stuff"]);
$ofh->field("description",$this->product->description,["width" => 300,"height" => 120]);
$ofh->field("shortText",$this->product->shortText,["width" => 300,"height" => 120]);
$ofh->field("releaseDate", $this->product->releaseDate);
$ofh->field("image", $this->product->image);
$ofh->field("finished", $this->product->finished);
$ofh->field("annoucedDateTime", $this->product->annoucedDateTime);
$ofh->field("timeForUpdates", $this->product->timeForUpdates);
$ofh->field("batteryHours", $this->product->batteryHours);
?>

