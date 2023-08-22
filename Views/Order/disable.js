const sleep = async (milliseconds) => {
    await new Promise(resolve => {
        return setTimeout(resolve, milliseconds)
    });
};

const DeshabilitarBoton = async () => {
    const btncompra = document.getElementById('btnPay');
    btncompra.disabled = true; 
    await sleep(5000);
    btncompra.disabled = false; 
};
