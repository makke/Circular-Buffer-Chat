/* END OF BODY SCRIPTS FOR RB-CHAT COLLECTED HERE */

// Let's update new messages from the server
updateFlow();

// user typed something
document.getElementById('newmessage').onkeyup = function (e) {
  // if the user pressed enter, then send the message to server
  // else just update possible new messages from server
  if (e.keyCode == 13) {
    sendMessage(this.value);
    document.getElementById('newmessage').value = "";
    document.getElementById('count').innerHTML = (MSG_LENGTH - this.value.length);
  } else {
    document.getElementById('count').innerHTML = (MSG_LENGTH - this.value.length);
    // Let's restart the timer before starting it again in updateFlow();
    clearTimeout(intervalTimer);
    timer_on = 0;
    // Then let's call the update which also restarts the timer
    updateFlow();
  }
};
