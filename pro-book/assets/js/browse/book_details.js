function orderBook(user_id, book_id) {
  const jumlah = document.getElementById('total-order').value

  fetch('/server/api/post_orders.php', { 
    method: 'post',
    body: JSON.stringify({
      user_id,
      book_id,
      rating: 0,
      comment: '',
      jumlah,
    })
  })
    .then(res => res.json())
    .then(status => { if (status === 0) { console.log(status) } else { openModal(status) } })
    .catch(err => console.error(err))
}
var browse_tab = document.getElementById("browse_tab");
browse_tab.className = "header_app_content orange-background hover_lightOrange";