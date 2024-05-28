const switchToDarkMode = () => {
  const leagueImages = document.querySelectorAll('.league-img');
  leagueImages.forEach(img => {
    const imgSrc = img.getAttribute('src');
    if (!imgSrc.includes('/dark/')) {
      const darkImgSrc = imgSrc.replace('/sf/', '/sf/dark/');
      img.setAttribute('src', darkImgSrc);
    }
  });
};

const switchToLightMode = () => {
  const leagueImages = document.querySelectorAll('.league-img');
  leagueImages.forEach(img => {
    const imgSrc = img.getAttribute('src');
    if (imgSrc.includes('/dark/')) {
      const lightImgSrc = imgSrc.replace('/sf/dark/', '/sf/');
      img.setAttribute('src', lightImgSrc);
    }
  });
};

// Initial setup based on stored mode
document.addEventListener('DOMContentLoaded', () => {
  const storedMode = window.localStorage.getItem('mode');
  if (storedMode === 'dark') {
    switchToDarkMode();
  } else {
    switchToLightMode();
  }
});

export { switchToDarkMode, switchToLightMode };
