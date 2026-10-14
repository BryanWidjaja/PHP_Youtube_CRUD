const content = document.getElementById("content");
const upload = document.getElementById("upload");
const contentContainer = document.querySelector(".content-container");

const fetchVideos = () => {
  fetch("/components/creatorVideos.php")
    .then((res) => {
      if (!res.ok) throw new Error("Response shit");
      return res.text();
    })
    .then((html) => {
      contentContainer.innerHTML = `<div class="video-container">${html}</div>`;
    })
    .catch((err) => {
      console.error(err);
    });
};

content.addEventListener("click", () => {
  content.classList.add("active");
  upload.classList.remove("active");
  fetchVideos();
});

upload.addEventListener("click", () => {
  content.classList.remove("active");
  upload.classList.add("active");
  contentContainer.innerHTML = `
    <p class="form-title">Upload Video</p>
    <p class="form-desc">Post a video to your channel</p>
    <form action="/components/upload.php" method="POST" id="video-form" enctype="multipart/form-data">
        <div class="main-form-container">
            <div class="form-item">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" id="title" placeholder="Add a title that describes your video" required>
            </div>
            
            <div class="form-item">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" placeholder="Tell viewers about your video"></textarea>
            </div>

            <div class="form-item">
              <label for="upload-thumbnail" class="form-label">Thumbnail</label>
              <input type="file" name="upload-thumbnail" id="upload-thumbnail">
            </div>

            <div class="form-item">
              <label class="form-label">Visibility</label>
              <div class="visibility-container">
                  <input type="radio" name="visibility" value="Public" checked>
                  <label>Public</label>
                  <input type="radio" name="visibility" value="Private">
                  <label>Private</label>
              </div>
            </div>
            
            <button type="submit" id="submit-btn">Publish</button>
        </div>

        <div class="video-upload-container">
            <label for="upload-video">Upload Video</label>
            <input type="file" name="upload-video" id="upload-video">
        </div>
    </form>
  `;
});

fetchVideos();
