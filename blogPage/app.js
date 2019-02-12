var mySiema = new Siema({
    duration: 500,
    loop: true,
    easing: 'ease-out',
    draggable: false,
    autoHover: true,
  });
  
  // listen for keydown event
  setInterval(() => mySiema.next(), 8000)

  document.querySelector('.prev').addEventListener('click', () => mySiema.prev());
  document.querySelector('.next').addEventListener('click', () => mySiema.next());