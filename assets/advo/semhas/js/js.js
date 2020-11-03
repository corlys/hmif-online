function disableButton(id, text) {
    $(`#${id}`).prop('disabled', true)
    $(`#${id}`).text(text)
}
function enableButton(id, text) {
    $(`#${id}`).text(text)
    $(`#${id}`).prop('disabled', false)
}
var table

function renderTable(res) {
    let index = 1
    let body = ''
    let crntUndangan = ''
    res.forEach((data) => {

        if (index == 1) {
            crntUndangan = data.undangan
            body += `<tr><td>${index++}</td><td>${data.ruangan}</td><td>${data.tanggal.substring(0, 10)}</td><td>${data.jam}</td><td>${data.undangan}</td>`
            body += `<td><b>${data.judul}</b><br><span style="color : blue">${data.nama}, NIM. <span class="nim">${data.nim}</span></span><br>Fasilitator : ${data.fasilitator}</td>`
            body += `<td><button class='pendaftarMhs btn btn-sm btn-success' data-undangan='${data.undangan}' data-nim='${data.nim}' ><i class='fa fa-eye'></i> Lihat </button></td>`
            body += `<td><button class='daftarAudiens btn btn-sm btn-primary' data-undangan='${data.undangan}' data-nim='${data.nim}'><i class='fa fa-note'></i> Daftar </button></td></tr>`
        } else {
            if (data.undangan == crntUndangan) {
                body += `<tr><td></td><td></td><td></td><td></td><td>${data.undangan}</td>`
                body += `<td><b>${data.judul}</b><br><span style="color : blue">${data.nama}, NIM. <span class="nim">${data.nim}</span></span><br>Fasilitator : ${data.fasilitator}</td>`
                body += '<td></td><td></td></tr>'
            } else {
                crntUndangan = data.undangan
                body += `<tr><td>${index++}</td><td>${data.ruangan}</td><td>${data.tanggal.substring(0, 10)}</td><td>${data.jam}</td><td>${data.undangan}</td>`
                body += `<td><b>${data.judul}</b><br><span style="color : blue">${data.nama}, NIM. <span class="nim">${data.nim}</span></span><br>Fasilitator : ${data.fasilitator}</td>`
                body += `<td><button class='pendaftarMhs btn btn-sm btn-success' data-undangan='${data.undangan}' data-nim='${data.nim}' ><i class='fa fa-eye'></i> Lihat </button></td>`
                body += `<td><button class='daftarAudiens btn btn-sm btn-primary' data-undangan='${data.undangan}' data-nim='${data.nim}'><i class='fa fa-note'></i> Daftar </button></td></tr>`
            }
        }




    })
    $('#data-semhas-body').html(body)
}

$(document).ready(() => {

    $.ajax({
        url: ling + 'pendataan-audiens-semhas/peserta-active',
        type: 'POST',
        dataType: 'JSON',
        data : {
            from : $('#fromDate').val(),
            to : $('#untilDate').val()
        },
        success(res) {
            renderTable(res)
        }
    })

    // table = $('#data-semhas').DataTable({
    //     serverMethod: 'post',
    //     destroy: true,
    //     scrollX: true,
    //     ajax: {
    //         url: ling + 'pendataan-audiens-semhas/peserta-active',
    //         data: function (data) {
    //             // Read values
    //             data.from = $('#fromDate').val();
    //             data.to = $('#untilDate').val();
    //         }
    //     },
    //     columns: [{
    //         data: 'no'
    //     },
    //     // {
    //     //     data: 'nim'
    //     // },
    //     // {
    //     //     data: 'nama',
    //     //     render : (data, type, row) => {
    //     //         return data + '<br>' + row.nim
    //     //     }
    //     // },
    //     {
    //         data: 'ruangan'
    //     },
    //     {
    //         data: 'tanggal'
    //     },
    //     {
    //         data: 'jam'
    //     },
    //     {
    //         data : 'undangan'
    //     },
    //     {
    //         render : (data,type, row) => {
    //             return `<b>${row.judul}</b><br><span style="color : blue">${row.nama}, NIM. <span class="nim">${row.nim}</span></span><br>Fasilitator : ${row.fasilitator}`
    //             // return `${row.judul}<br>`
    //         }
    //     },
    //     {
    //         data: 'pendaftar'
    //     },
    //     {
    //         data: 'aksi'
    //     }

    //     ],
    // })


    $('#filter-form').on('submit', (e) => {
        disableButton('filterButton', 'Filtering...')
        e.preventDefault()
        
        $.ajax({
            url: ling + 'pendataan-audiens-semhas/peserta-active',
            type: 'POST',
            dataType: 'JSON',
            data : {
                from : $('#fromDate').val(),
                to : $('#untilDate').val()
            },
            success(res) {
                renderTable(res)
                enableButton('filterButton', 'Filter')
            }
        })

        


    })

    var crntUndangan
    $('body').on('click', '.daftarAudiens', function () {
        // $('.addEditModal').attr('id', 'editForm')
        $('#daftarForm').trigger('reset')
        let undangan = $(this).data('undangan')
        crntUndangan = undangan
        // let nama = $(this).closest('tr').find('td').next().next().html()
        // let ruangan = $(this).closest('tr').find('td').next().next().next().html()
        // let tanggal = $(this).closest('tr').find('td').next().next().next().next().html()
        // let jam = $(this).closest('tr').find('td').next().next().next().next().next().html()
        // let limit = $(this).closest('tr').find('td').next().next().next().next().next().next().html()

        // $('input[name="nim"]').val(nim)
        // $('input[name="nama"]').val(nama)
        // $('input[name="ruangan"]').val(ruangan)
        // $('input[name="tanggal"]').val(tanggal)
        // $('input[name="jam"]').val(jam)
        // $('input[name="limit"]').val(limit)

        let people = $(this).closest('tr').find('.nim').text()

        // $('#exampleModalCenterTitle').text(people)
        $('#daftarModal').modal('show')
    })

    $('body').on('submit', '#daftarForm', function (e) {
        e.preventDefault()
        disableButton('saveButton', 'Mendaftar...')
        $.post(ling + 'pendataan-audiens-semhas/daftar?undangan=' + crntUndangan, $(this).serialize(), (data) => {
            console.log(data)
            if (data.status != 'Error' && data.errors == null) {
                // table.ajax.reload(null, false)
                alert('Sukses')
                $('#daftarModal').modal('hide')
            } else {
                if (data.msg) {
                    alert(data.msg);
                } else {
                    alert('Invalid data')
                }

            }
            enableButton('saveButton', 'Daftar')

        }, 'json').fail((e) => {
            console.log(e)
        })
    })

    $('body').on('click', '.pendaftarMhs', function () {
        let butt = $(this)
        butt.prop('disabled', true)
        butt.html(`<i class='fa fa-eye'></i> Melihat...`)
        let nimMhs = $(this).data('nim')
        let nama = $(this).closest('tr').find('td').next().next().html()
        // $('#exampleModalLongTitle').text(nama)
        $.ajax({
            url: ling + 'pendataan-audiens-semhas/pendaftar?undangan=' + $(this).data('undangan'),
            method: 'GET',
            dataType: 'JSON',
            success: (data) => {
                let table = '<table class="table"><tr><th>No</th><th>NIM</th><th>Nama</th><th>Timestamp</th></tr>'
                let index = 0
                data.pendaftar.pendaftar.forEach((el) => {
                    index++
                    table += `<tr><td>${index}</td><td>${el.nim}</td><td>${el.nama}</td><td>${moment(el.time).format('YYYY-MM-DD H:mm:ss')}</td></tr>`
                })
                table += '</table>'
                $('#pendaftarModalBody').html(table)
                $('#pendaftarModal').modal('show')

                butt.html(`<i class='fa fa-eye'></i> Lihat`)
                butt.prop('disabled', false)
            },
            error: (err) => {
                alert(err)
            }
        })

        // $('#exampleModalLong').modal('show')
    })



})

