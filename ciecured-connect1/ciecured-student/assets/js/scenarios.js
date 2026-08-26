/* ================= SCENARIO DIVIDERS ================= */
(function(){
  var items = document.querySelectorAll('.scenario-card-inner');

  items.forEach(function(item){
    item.addEventListener('click', function(){
      toggleItem(item);
    });
    item.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){
        e.preventDefault();
        toggleItem(item);
      }
    });
  });

  function toggleItem(item){
    var wrapper = item.closest('.scenario-card');
    var isOpen = wrapper.classList.contains('is-open');

    items.forEach(function(i){
      i.closest('.scenario-card').classList.remove('is-open');
      i.setAttribute('aria-expanded', 'false');
    });

    if(!isOpen){
      wrapper.classList.add('is-open');
      item.setAttribute('aria-expanded', 'true');
    }
  }
})();
