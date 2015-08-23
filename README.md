# Signature to Image

Signature to Image: A supplemental script for Signature Pad that generates an image of the signature’s JSON output server-side using PHP.

Signature Pad: <https://github.com/thomasjbradley/signature-pad>

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

---

## Complete Documentation

#### [☛ Complete documentation](documentation.md)

## Other Solutions

#### [☛ Other solutions](documentation.md#othersolutions)

---

## License

Signature Pad is licensed under the [New BSD license](https://github.com/thomasjbradley/signature-to-image/blob/master/NEW-BSD-LICENSE.txt).
