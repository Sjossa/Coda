export const toastUserEnabled = (text, level) => {
    const ToastElement = document.getElementById('mytoast')
    const toast = new bootstrap.Toast(ToastElement)

    document.querySelector('.toast-body').classList.remove('text-bg-success')
    document.querySelector('.toast-body').classList.add(level)
    document.querySelector('.toast-body').innerHTML = text
    toast.show()
}