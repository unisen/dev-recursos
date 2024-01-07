<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <title>File(s) size</title>
</head>

<body>
    <iframe id="viewer"></iframe>
   
   <script>
    const obj_url = URL.createObjectURL(blob);
    const iframe = document.getElementById("viewer");
    iframe.setAttribute("http://192.168.1.109/recursos/upload-files/contrato.pdf", obj_url);
    URL.revokeObjectURL(obj_url);
    </script>
</body>

</html>