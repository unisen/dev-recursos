<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <title>File(s) size</title>
</head>

<body>
    <form name="uploadForm">
        <div>
            <input id="uploadInput" type="file" multiple />
            <label for="fileNum">Selected files:</label>
            <output id="fileNum">0</output>;
            <label for="fileSize">Total size:</label>
            <output id="fileSize">0</output>
        </div>
        <hr>
        <div>
            <input type="file" id="fileElem" multiple accept="image/*" style="display:none" />
            <a href="#" id="fileSelect">Select some files</a>
            <div id="fileList">
                <p>No files selected!</p>
            </div>

        </div>
        <hr>
        <div><input type="submit" value="Send file" /></div>
    </form>

    <script>
    const uploadInput = document.getElementById("uploadInput");
    uploadInput.addEventListener(
        "change",
        () => {
            // Calculate total size
            let numberOfBytes = 0;
            for (const file of uploadInput.files) {
                numberOfBytes += file.size;
            }

            // Approximate to the closest prefixed unit
            const units = [
                "B",
                "KiB",
                "MiB",
                "GiB",
                "TiB",
                "PiB",
                "EiB",
                "ZiB",
                "YiB",
            ];
            const exponent = Math.min(
                Math.floor(Math.log(numberOfBytes) / Math.log(1024)),
                units.length - 1,
            );
            const approx = numberOfBytes / 1024 ** exponent;
            const output =
                exponent === 0 ?
                `${numberOfBytes} bytes` :
                `${approx.toFixed(3)} ${
                  units[exponent]
                } (${numberOfBytes} bytes)`;

            document.getElementById("fileNum").textContent =
                uploadInput.files.length;
            document.getElementById("fileSize").textContent = output;
        },
        false,
    );
    </script>

    <script>
    const fileSelect = document.getElementById("fileSelect"),
  fileElem = document.getElementById("fileElem"),
  fileList = document.getElementById("fileList");

fileSelect.addEventListener(
  "click",
  (e) => {
    if (fileElem) {
      fileElem.click();
    }
    e.preventDefault(); // prevent navigation to "#"
  },
  false,
);

fileElem.addEventListener("change", handleFiles, false);

function handleFiles() {
  if (!this.files.length) {
    fileList.innerHTML = "<p>No files selected!</p>";
  } else {
    fileList.innerHTML = "";
    const list = document.createElement("ul");
    fileList.appendChild(list);
    for (let i = 0; i < this.files.length; i++) {
      const li = document.createElement("li");
      list.appendChild(li);

      const img = document.createElement("img");
      img.src = URL.createObjectURL(this.files[i]);
      img.height = 60;
      img.onload = () => {
        URL.revokeObjectURL(img.src);
      };
      li.appendChild(img);
      const info = document.createElement("span");
      info.innerHTML = `${this.files[i].name}: ${this.files[i].size} bytes`;
      li.appendChild(info);
    }
  }
}

    </script>
</body>

</html>