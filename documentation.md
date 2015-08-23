# Signature to Image Documentation

**A supplemental script for Signature Pad that generates an image of the signature’s JSON output server-side using PHP.**

---

- [Introduction](#introduction)
- [How-to](#how-to)
	- [How-to: Step-by-Step](#how-to--step-by-step)
- [Function Reference](#function-reference)
- [Options](#options)
	- [Options Reference](#options-reference)
- [Version History](#version-history)
- [License](#license)
- [Other Solutions](#other-solutions)

---

## Introduction

Signature to Image is a simple PHP script that will take the JSON output of [Signature Pad](https://github.com/thomasjbradley/signature-pad/) and generate an image file server-side to be saved for later. Uses the GD Image Library for image generation and PHP’s built in `json_decode()` if a string is passed.

## How-to

The whole signature to image generation requires just a few lines of PHP:

```php
<?php
require_once 'signature-to-image.php';

$json = $_POST['output'];
$img = sigJsonToImage($json);

imagepng($img, 'signature.png');
imagedestroy($img);
```

### How-to: Step-by-Step

First, include the required PHP file: `signature-to-image.php`.

```php
<?php
require_once 'signature-to-image.php';
```

Get the signature from the form post. Signature Pad defaults to naming the post field as `output`.

```php
<?php
$json = $_POST['output'];
```

Then, call the function, passing a string representing the JSON, submitted by [Signature Pad](https://github.com/thomasjbradley/signature-pad/), or an already decoded JSON object (using `json_decode()`).

```php
<?php
$img = sigJsonToImage($json);
```

The `$img` variable will be an image resource, which you can either display immediately or save to a file.

#### Save to file

```php
<?php
imagepng($img, 'signature.png');
```

#### Display in the browser

```php
<?php
header('Content-Type: image/png');
imagepng($img);
```

#### Cleanup

When you have finished with the image resource, make sure to clean up after yourself and free some memory.

```php
<?php
imagedestroy($img);
```

---

## Function Reference

<table class="reference">
  <col class="method">
  <col class="arguments">
  <col class="return">
  <col class="description">
  <thead>
    <tr>
      <th scope="col">Method</th>
      <th scope="col">Arguments</th>
      <th scope="col">Return</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>sigJsonToImage(<br><var>$json</var>, <var>$options</var>)</code></td>
      <td class="arguments">
        <code><var>$json</var>:<i>json|string</i></code><p>String or decoded JSON representing the signature output</p>
        <code><var>$options</var>:<b>array</b></code><p>Array of properties to change the default options</p>
      </td>
      <td class="return"><code><i>image resource</i></code></td>
      <td><p>Redraws the signature as a GD Library image resource</td>
    </tr>
  </tbody>
</table>

---

## Options

Options can be passed as the second argument of the function when called. Only options that are different from the defaults need to be included in the options array.

```php
<?php
$img = sigJsonToImage($json, array('imageSize'=>array(198, 55)));
```

It’s highly recommended that the options used server-side match the values used in the Javascript.

### Options Reference

<table class="reference alternate">
  <col class="name">
  <col class="type">
  <col class="value">
  <col class="description">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Type</th>
      <th scope="col">Default Value</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="name"><code><span class="s">imageSize</span></code></td>
      <td class="type"><code><b>array</b></code><p>width, height</p></td>
      <td class="value"><code><b>array</b>(<span class="o">198</span>, <span class="o">55</span>)</code></td>
      <td><p>Determines the final output size of the image</p></td>
    </tr>
    <tr>
      <td class="name"><code><span class="s">bgColour</span></code></td>
      <td class="type">
        <code><b>array</b></code>
        <p>hex red, hex green, hex blue</p>
        <code><b>string</b></code>
        <p>transparent</p>
      </td>
      <td class="value"><code><b>array</b>(<span class="o">0xff</span>, <span class="o">0xff</span>, <span class="o">0xff</span>)</code></td>
      <td>
        <p>The colour fill for the background of the image</p>
        <p>Transparency:<br><code><b>array</b>(<span class="s">'bgColour'</span> =&gt; <span class="s">'transparent'</span>)</code></p>
      </td>
    </tr>
    <tr>
      <td class="name"><code><span class="s">penWidth</span></code></td>
      <td class="type"><code><i>int</i></code></td>
      <td class="value"><code><span class="o">2</span></code></td>
      <td><p>Thickness, in pixels, of the drawing pen</p></td>
    </tr>
    <tr>
      <td class="name"><code><span class="s">penColour</span></code></td>
      <td class="type"><code><b>array</b></code><p>hex red, hex green, hex blue</td>
      <td class="value"><code><b>array</b>(<span class="o">0x14</span>, <span class="o">0x53</span>, <span class="o">0x94</span>)</code></td>
      <td><p>Colour of the drawing ink</p></td>
    </tr>
    <tr>
      <td class="name"><code><span class="s">drawMultiplier</span></code></td>
      <td class="type"><code><i>int</i></code></td>
      <td class="value"><code><span class="o">12</span></code></td>
      <td><p>The signature is enlarged by this factor before being redrawn to maintain a smooth finish. <em>Reduce this only if you are having memory issues.</em></p></td>
    </tr>
  </tbody>
</table>

---

## Version History

Check out the [changelog on GitHub](https://github.com/thomasjbradley/signature-to-image/blob/master/CHANGELOG.md).

---

## License

Signature to Image is licensed under the <a href="https://github.com/thomasjbradley/signature-to-image/blob/master/NEW-BSD-LICENSE.txt" rel="license">New BSD license</a>, which is included in the downloadable package.

---

## Other Solutions

- PHP to SVG: [sigToSvg](https://github.com/chaz-meister/sigToSvg/) by [Charles Gebhard](http://www.pointsystems.com/) is a script for converting the signature JSON to SVG using PHP. Check out the amazing [sigToSvg on GitHub](https://github.com/chaz-meister/sigToSvg/).
- Python: [python-signpad2image](https://github.com/videntity/python-signpad2image) by [Alan Viars](http://videntity.com) is a script for converting the signature JSON to PNG using Python. Check out the fantastico [python-signpad2image on GitHub](https://github.com/videntity/python-signpad2image).
- Ruby on Rails: [ruby-signaturepad-to-image.rb](https://gist.github.com/4258871) by [Phil Hofmann](https://github.com/branch14) is a chunk of code for converting signature JSON to PNG within a Ruby on Rails app. Check out the wam-bham [ruby-signaturepad-to-image.rb on Github](https://gist.github.com/4258871).
- C#: [SignatureToDotNet](https://github.com/parrots/SignatureToImageDotNet) by [Curtis Herbert](http://www.consumedbycode.com) is a script for converting the signature JSON to an image using C#. Check out the awesome [SignatureToDotNet project on GitHub](https://github.com/parrots/SignatureToImageDotNet).
- Perl: [signature-to-image.pl](http://search.cpan.org/~turnerjw/JSON-signature-to-image-1.0/signature-to-image.pl) by [Jim Turner](http://home.mesh.net/turnerjw/jim/) is a script for converting the signature JSON to a PNG using Perl. Check out the fabulous [signature-to-image.pl on CPAN](http://search.cpan.org/~turnerjw/JSON-signature-to-image-1.0/signature-to-image.pl).
- ColdFusion: [sigJsonToImage](http://www.cflib.org/udf/sigJsonToImage) by [James Moberg](http://www.ssmedia.com/) is a script for converting the signature JSON to an PNG using ColdFusion. Check out the super-duper [sigJsonToImage project on CFLib.org](http://www.cflib.org/udf/sigJsonToImage).
- Java: [SignatureToImageJava](https://github.com/vinodkiran/SignatureToImageJava) by [Vinod Kiran](https://github.com/vinodkiran) is a script for converting the signature JSON to an image using Java. Check out the rad [SignatureToImageJava project on GitHub](https://github.com/vinodkiran/SignatureToImageJava).
