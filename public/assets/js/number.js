function convert(bilangan, prefix) {
    var number_string = String(bilangan).replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
        sisa    = split[0].length % 3,
        rupiah  = split[0].substr(0, sisa),
        ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
        
    if(ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function number(rupiah) {
	return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}

function rupiah(param) {
	return 'Rp' + new Intl.NumberFormat('id-ID').format(param)
}