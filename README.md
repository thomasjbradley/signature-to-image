# Signature to Image

Signature to Image: A supplemental script for Signature Pad that generates an image of the signature’s JSON output server-side using PHP.

Signature Pad: <http://thomasjbradley.ca/lab/signature-pad>

Copyright MMXI, Thomas J Bradley <hey@thomasjbradley.ca>

Versioned using Semantic Versioning <http://semver.org/>

## Quick Start
```php
require_once 'signature-to-image.php';

$json = $_POST['output']; // From Signature Pad
$img = sigJsonToImage($json);

imagepng($img, 'signature.png');
imagedestroy($img);
```

## Complete Documentation
<http://thomasjbradley.ca/lab/signature-to-image>

## Other Solutions
<http://thomasjbradley.ca/lab/signature-to-image/#othersolutions>

## Source Code
<http://github.com/thomasjbradley/signature-to-image>

## License
Signature Pad is licensed under the [New BSD license](https://github.com/thomasjbradley/signature-to-image/blob/master/NEW-BSD-LICENSE.txt).
