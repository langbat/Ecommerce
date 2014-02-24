<div id="recorderContainer">
    <div id="playerContainer">

    </div>
</div>


<script  type="text/javascript">
    var recorderManager;
    var recorder;
    var player;
    var TOKEN = "84fc7672abf041b4b4da0b66f43bdc05a67fde01"; // Replace with a generated token that has been assigned the role of moderator.
    // See https://dashboard.tokbox.com/projects
    var API_KEY = "44587792";  // Replace with your API key. See https://dashboard.tokbox.com/projects

    recorderManager = TB.initRecorderManager(API_KEY);

    var recDiv = document.createElement("div");
    var recDivId = "recorder" + new Date().getTime().toString();
    recDiv.setAttribute("id", recDivId);
    document.getElementById("recorderContainer").appendChild(recDiv); // Replace with the ID of the container DOM element.
    //recorderManager.startRecording();
    recorder = recorderManager.displayRecorder(TOKEN, recDivId );
    var newStyle = {
        buttonDisplayMode: "on",
        showPlayButton  : true,
        showRecordButton : true,
        showSettingsButton: false
    };
    recorder.setStyle(newStyle);

    //recorder.addEventListener("archiveSaved", archiveSavedHandler);

    function archiveSavedHandler(event) {
        recorderManager.removeRecorder(recorder);
        loadArchive(event.archives[0].archiveId); // You will want to save the archive ID on your server, for future playback.
    }

    function loadArchive(archiveId) {
        playerDiv = document.createElement("div");
        var playerDivId = "player" + archiveId;
        playerDiv.setAttribute("id", playerDivId);
        document.getElementById("playerContainer").appendChild(playerDiv);
        player = recorderManager.displayPlayer(archiveId, TOKEN, playerDivId);
    }
</script>