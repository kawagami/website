// const { default: Axios } = require("axios")

function handleStockDel() {
    const rootNode = this.parentNode.parentNode
    if (confirm(`確定要刪除${this.dataset.id}嗎?`)) {
        axios.delete(`/home/stocks/${this.dataset.id}`).then(
            response => {
                if (response.data == 'success') {
                    rootNode.remove()
                } else {
                    alert('No permission!');
                }
            }
        )
    }
}

const allDelBtn = document.querySelectorAll('.stock-del')
allDelBtn.forEach(delBtn => delBtn.addEventListener('click', handleStockDel))