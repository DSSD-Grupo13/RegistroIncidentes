function cancelar(action) {
    if(confirm("¿Seguro que deseas cancelar?")) {
        document.location.href = './?action='+ action;
    }
}
