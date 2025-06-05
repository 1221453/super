function toggleSecao(id) {
  const secao = document.getElementById(id);
  if (secao) {
    secao.style.display = (secao.style.display === "none") ? "block" : "none";
  }
}