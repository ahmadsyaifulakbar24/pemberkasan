function fullDate(date) {

	var day = []
	day[0] = 'Min'
	day[1] = 'Sen'
	day[2] = 'Sel'
	day[3] = 'Rab'
	day[4] = 'Kam'
	day[5] = 'Jum'
	day[6] = 'Sab'

	var month = []
	month['01'] = 'Januari'
	month['02'] = 'Februari'
	month['03'] = 'Maret'
	month['04'] = 'April'
	month['05'] = 'Mei'
	month['06'] = 'Juni'
	month['07'] = 'Juli'
	month['08'] = 'Agustus'
	month['09'] = 'September'
	month['10'] = 'Oktober'
	month['11'] = 'November'
	month['12'] = 'Desember'

	var tgl = date.substr(8, 2)
	var bln = date.substr(5, 2)
	var thn = date.substr(0, 4)
	
	var hari = day[new Date(thn+'-'+bln+'-'+tgl).getDay()]
	var bulan = month[bln]
	var tanggal = tgl+' '+bulan+' '+thn
	// var tanggal = hari+', '+tgl+' '+bulan+' '+thn

	return(tanggal)
}

function shortDate(date) {

	var d = date.getDate()
	var m = date.getMonth()+1
	var y = date.getFullYear()

	var month = []
	month['1'] = 'Jan'
	month['2'] = 'Feb'
	month['3'] = 'Mar'
	month['4'] = 'Apr'
	month['5'] = 'Mei'
	month['6'] = 'Jun'
	month['7'] = 'Jul'
	month['8'] = 'Agu'
	month['9'] = 'Sep'
	month['10'] = 'Okt'
	month['11'] = 'Nov'
	month['12'] = 'Des'
	
	var bulan = month[m]
	// if(new Date().getFullYear() == y) {
	// 	var tanggal = d+' '+bulan
	// } else {
		var tanggal = d+' '+bulan+' '+y
	// }

	return(tanggal)
}