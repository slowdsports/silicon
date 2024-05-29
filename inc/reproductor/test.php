<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Embed and Refresh Buttons</title>
<style>
.vid_ch {
    position: absolute;
    z-index: 999;
    left: 8px;
    top: 6px;
    right: 8px;
    height: 0;
}
.btn-zhc-dark:hover {
    color: #fff;
    background-color: #23272b;
    border-color: #1d2124;
}
.vid_ch .refresh {
    float: right;
}
.btn-zhc-dark {
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;
}
.btn-zhc {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    /*line-height: 1.5;*/
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    cursor: pointer;
}
#share_channel {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9;
    background: rgba(0, 0, 0, .7);
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    display: none;
}
.share-channel {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
}
.share_title {
    font-size: 1.25rem;
    margin-bottom: 10px;
}
.custom-btn {
    margin-top: 10px;
}
</style>
</head>
<body>

<div class="vid_ch">
<a class="btn-zhc btn-zhc-dark refresh" href="javascript:window.location.reload()">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor">
    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"></path>
    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"></path>
  </svg>
</a>
<span onclick="toggleShare()">
  <a class="btn-zhc btn-zhc-dark share">
    <svg fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
      <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3"></path>
    </svg>
  </a>
</span> 
</div>

<div id="share_channel" onclick="toggleShare()">
  <div class="share-channel" onclick="event.stopPropagation();">
    <div class="share_title">Embed Code</div>
    <div class="share-channel-content">
      <textarea id="player_share" onclick="this.select();" onfocus="this.select();"></textarea>
      <button class="btn-zhc custom-btn" onclick="copyAndClose()">Click to Copy</button>
    </div>
  </div>
</div>

<script>
function toggleShare() {
  const shareChannel = document.getElementById('share_channel');
  shareChannel.style.display = shareChannel.style.display === 'none' || shareChannel.style.display === '' ? 'flex' : 'none';

  if (shareChannel.style.display === 'flex') {
    const textarea = document.getElementById('player_share');
    const currentUrl = window.location.href;
    const embedCode = `<iframe src="${currentUrl}" width="600" height="400" frameborder="0" allowfullscreen allow="encrypted-media"></iframe>`;
    textarea.value = embedCode;
  }
}

function copyAndClose() {
  const textarea = document.getElementById('player_share');
  textarea.select();
  document.execCommand('copy');
  toggleShare();
  alert('Embed code copied to clipboard!');
}
</script>

</body>
</html>
