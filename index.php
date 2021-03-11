<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dropbox Pre-built components</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs"
            data-app-key="zzzzzzzzzzzzzzzz"></script>
    <style>
        #chooser-demo {
            height: 100px;
            font-size: 24px;
        }
       
        #element {
            height: 600px;
        }

    </style>
</head>
<body>
<section class="section">
    <div class="container">
        <h1 class="title has-text-primary">Dropbox Pre-built components</h1>

        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <h2 class="title"><a href="https://www.dropbox.com/developers/chooser">Chooser</a></h2>
                    <p class="subtitle">The Chooser is the fastest way to get files from Dropbox into your web, Android, or iOS app. It's a small component that enables your app to get files from Dropbox without having to worry about the complexities of implementing a file browser, authentication, or managing uploads and storage.</p>
                    <div id="chooser-demo"></div>
                    <article class="message is-success" id="selected-link">
                        <div class="message-header">
                            <p>Success: Selected Link</p>
                        </div>
                        <div class="message-body">
                            <a href="" id="link"></a>
                        </div>
                    </article>
                </article>

            </div>

        </div>

        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <h2 class="title"><a href="https://www.dropbox.com/developers/embedder">Embedder</a></h2>
                    <p class="subtitle">The Embedder allows you to use shared links to embed previews of Dropbox files
                        or folders inside your web app.</p>
                    <div id="element"></div>
                </article>
            </div>

        </div>
        <div class="tile is-ancestor">
          <div class="tile is-parent">
            <article class="tile is-child box">
              <h2 class="title">
                <a href="https://www.dropbox.com/developers/saver">Saver</a>
              </h2>
              <p class="subtitle">
                The Saver is the easiest way to add files to your users'
                Dropboxes. With two clicks, a user can download files of any
                size into their Dropbox, making those files available on all
                their computers and devices as soon as the download completes.
                The Saver is a Drop-in component that works on web and mobile
                web—all with just a few lines of code.
              </p>
              <a
                href="https://dl.dropboxusercontent.com/s/deroi5nwm6u7gdf/advice.png"
                class="dropbox-saver"
              ></a>
            </article>
          </div>
        </div>
    </div>

</section>

<script>
     var options = {
            // Shared link to Dropbox file
            link: "https://www.dropbox.com/sh/l9g9wex6h421j8g/AADucflsvuw-IcM7bZfa-p0la?dl=0",
            file: {
                // Sets the zoom mode for embedded files. Defaults to 'best'.
                zoom: "best" // or "fit"
            },
            folder: {
                // Sets the view mode for embedded folders. Defaults to 'list'.
                view: "grid", // or "list"
                headerSize: "small" // or "normal"
            }
        }
        let element = document.getElementById('element');
        Dropbox.embed(options, element);
    let selectedLink = document.getElementById("selected-link");
    selectedLink.style.display = "none";
    options = {

        // Required. Called when a user selects an item in the Chooser.
        success: function(files) {
            selectedLink.style.display = "block";
            let link = document.getElementById('link');
            link.innerHTML = files[0].link;
            link.href = files[0].link;
        },

        // Optional. Called when the user closes the dialog without selecting a file
        // and does not include any parameters.
        cancel: function() {
            selectedLink.style.display = "none";
            
        },

        // Optional. "preview" (default) is a preview link to the document for sharing,
        // "direct" is an expiring link to download the contents of the file. For more
        // information about link types, see Link types below.
        linkType: "preview", // or "direct"

        // Optional. A value of false (default) limits selection to a single file, while
        // true enables multiple file selection.
        multiselect: false, // or true

        // Optional. This is a list of file extensions. If specified, the user will
        // only be able to select files with these extensions. You may also specify
        // file types, such as "video" or "images" in the list. For more information,
        // see File types below. By default, all extensions are allowed.
        extensions: ['.pdf', '.doc', '.docx', '.png'],

        // Optional. A value of false (default) limits selection to files,
        // while true allows the user to select both folders and files.
        // You cannot specify `linkType: "direct"` when using `folderselect: true`.
        folderselect: false, // or true

        // Optional. A limit on the size of each file that may be selected, in bytes.
        // If specified, the user will only be able to select files with size
        // less than or equal to this limit.
        // For the purposes of this option, folders have size zero.
        //sizeLimit: 1024, // or any positive number
    };

    var button = Dropbox.createChooseButton(options);
    document.getElementById("chooser-demo").appendChild(button);
    
    var options = {
        files: [
            // You can specify up to 100 files.
            {'url': '...', 'filename': '...'},
            {'url': '...', 'filename': '...'},
            // ...
        ],
    
        // Success is called once all files have been successfully added to the user's
        // Dropbox, although they may not have synced to the user's devices yet.
        success: function () {
            // Indicate to the user that the files have been saved.
            alert("Success! Files saved to your Dropbox.");
        },
    
        // Progress is called periodically to update the application on the progress
        // of the user's downloads. The value passed to this callback is a float
        // between 0 and 1. The progress callback is guaranteed to be called at least
        // once with the value 1.
        progress: function (progress) {},
    
        // Cancel is called if the user presses the Cancel button or closes the Saver.
        cancel: function () {},
    
        // Error is called in the event of an unexpected response from the server
        // hosting the files, such as not being able to find a file. This callback is
        // also called if there is an error on Dropbox or if the user is over quota.
        error: function (errorMessage) {}
    };
    var button = Dropbox.createSaveButton(options);
    document.getElementById("container").appendChild(button);
    Dropbox.createSaveButton(url, filename, options);
</script>
</body>
</html>