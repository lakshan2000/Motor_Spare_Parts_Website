<script>
document.addEventListener('DOMContentLoaded', function() {
var successMsg = document.querySelector('.success-msg-box');
if (successMsg) {
  successMsg.style.display = 'block';
  successMsg.style.transition = 'transform 0.5s ease-in-out'; 
  successMsg.style.transform = 'translateX(100%)'; 
  setTimeout(function() {
    successMsg.style.transform = 'translateX(0)'; 
  }, 0);

  setTimeout(function() {
    successMsg.style.transform = 'translateX(100%)'; 
  }, 2500);
}
});

document.addEventListener('DOMContentLoaded', function() {
var successMsg = document.querySelector('.error-msg-box');
if (successMsg) {
  successMsg.style.display = 'block';
  successMsg.style.transition = 'transform 0.5s ease-in-out'; 
  successMsg.style.transform = 'translateX(100%)';

  setTimeout(function() {
    successMsg.style.transform = 'translateX(0)'; 
  }, 0);

  setTimeout(function() {
    successMsg.style.transform = 'translateX(100%)'; 
  }, 2500);
}
});


</script>

