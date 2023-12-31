$(function () {

    const cd = '/json/ec01wxyb1-4adc2.json';

    const request = new XMLHttpRequest();

    request.open('GET', cd);
    request.responseType = 'json';
    request.send();

    data = [];

    request.onload = function() {
        selectDep(request.response);

        //edit Select2
        llenarSelect2Edit(request.response);
    }
    
    // Select2 edit
    $(".select2").select2();
    
    $('.table').DataTable( {
        order: [[ 0, 'desc' ]],
        select: true,
        lengthMenu: [ [10,15, 30, 50, -1], [10,15, 30, 50, "Todos"] ],
        pagingType: 'full_numbers',
        language: {
            lengthMenu:       "_MENU_",
            zeroRecords:      "No se encontro registros",
            search:           "",
            paginate: {
                first:    '«',
                previous: '‹',
                next:     '›',
                last:     '»'
            },
            aria: {
                paginate: {
                    first:    'First',
                    previous: 'Previous',
                    next:     'Next',
                    last:     'Last'
                }
            },
            info:             "_START_ a _END_ de _TOTAL_",
            infoFiltered:     "(filtrado de _MAX_ registros totales)",
            infoEmpty:        "0 a 0 de 0"
        },
    });
});
$(document).ready(function() {
    $('#date_start').blur(function () {
        if (this.value) {
            $('#users').prop('disabled',false);
            $('#vehicles').prop('disabled',false);
            usersDisable(this.value);
            vehiclesDisable(this.value);

            $('#vehicles').val(null).trigger('change');
            $('#users').val(null).trigger('change');
        }
    });
    $('#add-activities').click(function () {
        $('#activities').clone().appendTo('#destino-activities').val('');
    });
    $('.open-modal-inv').click(function () {
        let users = $('#users').val();
        users.forEach(idU => {
            let name = $('#option_user_'+idU).text();
            $('<option>',{
                'value' : idU,
                'text' : name,
            }).appendTo('.inv_user');
        });
    });
    $('.inv_user').change(function (){
        $('.inv_user').val(this.value);
    });

    $('.amounts-consumables').blur(function () {
        $('.has-error').removeClass('has-error');
        elem = $(this);
        value = elem.val();
        amount = elem.parent().parent().children('.col-md-3').text().split('/ ')[1];
        if (parseFloat(value) > parseFloat(amount)) {
            elem.parent().addClass('has-error');
        }
    });
    $('#eb').change(function(){
        if (this.value == 0) {
            $('.station-other').show();
            $('#station_name').val('');
            $('#lat').val('');
            $('#long').val('');
        }else {
            $('.station-other').hide();
            $('#station_name').val('');
            $('#lat').val('');
            $('#long').val('');
        }
    });
});

function usersDisable(date) {
    resetUsers();
    newDate = moment(date);
    dates = $('.date-starts');
    for (let i = 0; i < dates.length; i++) {
        let newDates = moment(dates[i].innerText);
        if (newDate.format('YYYY-MM-DD') == newDates.format('YYYY-MM-DD')) {
            let eleUsers = $(dates[i]).parent().parent().children('.list-user').children();
            for (let j = 0; j < eleUsers.length; j++) {
                let id = eleUsers[j].id.split('-')[(eleUsers[j].id.split('-').length - 1)];
                $('#option_user_'+id).prop('disabled',true).text(eleUsers[j].innerText+' (no disponible)');
            }
        }
    }

    // Usuarios de permisos
    let datesStart = $('.permission-dateStart');
    let datesEnd = $('.permission-dateEnd');
    let timeStart = $('.permission-timeStart');
    let timeEnd = $('.permission-timeEnd');
    let idUser = $('.permission-idUser');
    let type = $('.permission-type');
    let status = $('.permission-status');
    for (let i = 0; i < datesStart.length; i++) {
        let newDatesStart = moment(datesStart[i].value);
        let newDatesEnd = moment(datesEnd[i].value);
        if (newDate.format('YYYY-MM-DD') >= newDatesStart.format('YYYY-MM-DD') && newDate.format('YYYY-MM-DD') <= newDatesEnd.format('YYYY-MM-DD')) {
            if (status[i].value != 'No aprobado' && $('#option_user_'+idUser[i].value).text().indexOf(' (') == -1) {
                let state = status[i].value == 'Aprobado' ? true : false;
                let textState = status[i].value == 'Sin aprobar' ? ' sin aprobar' : '';
                $('#option_user_'+idUser[i].value).prop('disabled',state).text($('#option_user_'+idUser[i].value).text()+' ('+type[i].value+textState+')');
            }
        }
    }
}
function vehiclesDisable(date) {
    resetVehicles();
    newDate = moment(date);
    dates = $('.date-starts');
    for (let i = 0; i < dates.length; i++) {
        let newDates = moment(dates[i].innerText);
        if (newDate.format('YYYY-MM-DD') == newDates.format('YYYY-MM-DD')) {
            let eleVehicles = $(dates[i]).parent().parent().children('.list-vehicles').children();
            for (let j = 0; j < eleVehicles.length; j++) {
                let id = eleVehicles[j].id.split('-')[(eleVehicles[j].id.split('-').length - 1)];
                let text = $('#option_vehicle_'+id).text();
                if (text.indexOf(" (") == -1) {
                    $('#option_vehicle_'+id).prop('disabled',true).text(text+' (no disponible)');
                    if ($('#vehicles').find("option[value='" + data.id + "']").length) {
                        
                    }
                }
            }
        }
    }

    let id = $('.data-vehicles-id');
    let plate = $('.data-vehicles-plate');
    let enrollmentDate = $('.data-vehicles-enrollment-date');
    let soatDate = $('.data-vehicles-soat-date');
    let gasesDate = $('.data-vehicles-gases-date');
    let technomechanicalDate = $('.data-vehicles-technomechanical-date');
    for (let i = 0; i < id.length; i++) {
        let newEnrollmentDate = moment(enrollmentDate[i].value);
        let newSoatDate = moment(soatDate[i].value);
        let newGasesDate = moment(gasesDate[i].value);
        let newTechnomechanicalDate = moment(technomechanicalDate[i].value);
        if (newDate.format('YYYY-MM-DD') > newEnrollmentDate.format('YYYY-MM-DD') || newDate.format('YYYY-MM-DD') > newSoatDate.format('YYYY-MM-DD') || newDate.format('YYYY-MM-DD') > newGasesDate.format('YYYY-MM-DD') || newDate.format('YYYY-MM-DD') > newTechnomechanicalDate.format('YYYY-MM-DD')) {
            let textOrg = $('#option_vehicle_'+id[i].value).text();
            if (textOrg.indexOf(' (') == -1) {
                console.log('Para la fecha',textOrg);
                $('#option_vehicle_'+id[i].value).prop('disabled',false).text(textOrg+' (documentos vencidos para la fecha)');
            }
        }
    }
}

function resetUsers() {
    let usersOption =  $('#users').children();
    for (let i = 0; i < usersOption.length; i++) {
        if (usersOption[i].innerText.indexOf('(') != -1) {
            $('#option_user_'+usersOption[i].value).prop('disabled',false).text(usersOption[i].innerText.split(' (')[0]);
        }
    }
}

function resetVehicles() {
    let vehiclesOption =  $('#vehicles').children();
    for (let i = 0; i < vehiclesOption.length; i++) {
        if (vehiclesOption[i].innerText.indexOf(' (no disponible)') != -1 || vehiclesOption[i].innerText.indexOf(' (documentos vencidos para la fecha)') != -1) {
            $('#option_vehicle_'+vehiclesOption[i].value).prop('disabled',false).text(vehiclesOption[i].innerText.split(' (')[0]);
        }
    }
}

function selectDep(response) {
    response.CD.forEach(element => {
        data.push({
            id: element.DEPARTAMENTO.toUpperCase(),
            text: element.DEPARTAMENTO.toUpperCase()
        });
    });
    response.EB.forEach(element => {
        data.push({
            id: element.departamento.toUpperCase(),
            text: element.departamento.toUpperCase()
        });
    });
    dataMap = data.map(item=>{
        return [item.id,item]
    });
    dataMapArr = new Map(dataMap)
    unicos = [...dataMapArr.values()];
    unicos.sort(GetSortOrder("text"));
    $("#department").select2({
        data: unicos
    }).change(function () {
        $('#municipality').prop('disabled',false);
        $("#eb").empty()
        selectMunicipaly(this.value,response);
    });
}

function selectMunicipaly(value,response) {
    data = [];
    response.CD.forEach(element => {
        if (element.DEPARTAMENTO.toUpperCase() == value) {
            data.push({
                id: element.MUNICIPIOANM.toUpperCase(),
                text: element.MUNICIPIOANM.toUpperCase()
            });
        }
    });
    response.EB.forEach(element => {
        if (element.departamento.toUpperCase() == value) {
            data.push({
                id: element.municipio.toUpperCase(),
                text: element.municipio.toUpperCase()
            });
        }
    });
    dataMap = data.map(item=>{
        return [item.id,item]
    });
    dataMapArr = new Map(dataMap)
    unicos = [...dataMapArr.values()];
    unicos.unshift({
        id: '',
        text: '',
        disabled: true,
        selected: true
    });
    unicos.sort(GetSortOrder("text"));
    $("#municipality").empty()
    $("#municipality").select2({
        data: unicos
    }).change(function () {
        $('#eb').prop('disabled',false);
        selectEB(this.value,response);
    });
}

function selectEB(value,response) {
    data = [];
    response.CD.forEach(element => {
        if (element.MUNICIPIOANM.toUpperCase() == value) {
            data.push({
                id: element.Consecutivo_Sede,
                text: (element.INSTITUCIÓN_EDUCATIVA+' '+element.NOMBRE_SEDE).toUpperCase()
            });
        }
    });
    response.EB.forEach(element => {
        if (element.municipio.toUpperCase() == value) {
            data.push({
                id: element.id,
                text: element.sitio.toUpperCase()
            });
        }
    });
    dataMap = data.map(item=>{
        return [item.id,item]
    });
    dataMapArr = new Map(dataMap)
    unicos = [...dataMapArr.values()];
    
    unicos.sort(GetSortOrder("text"));
    unicos.unshift({
        id: 0,
        text: "OTRA"
    });
    unicos.unshift({
        id: '',
        text: '',
        disabled: true,
        selected: true
    });
    $("#eb").empty();
    $("#eb").select2({
        data: unicos
    }).change(function () {
        $('#eb').prop('disabled',false);
        selectLocation(this.value,response);
    });
}

function selectLocation(value,response) {
    response.CD.forEach(element => {
        if (element.Consecutivo_Sede == value) {
            $('#station_name').val(element.NOMBRE_SEDE);
            $('#lat').val(element.LATITUD);
            $('#long').val(element.LONGITUD);
        }
    });
    response.EB.forEach(element => {
        if (element.id == value) {
            $('#station_name').val(element.sitio);
            $('#lat').val(element.Latitud);
            $('#long').val(element.Longitud);
        }
    });
}

function selectEditLocation(id,value,response) {
    response.CD.forEach(element => {
        if (element.Consecutivo_Sede == value) {
            $('#station_name-edit-'+id).val(element.NOMBRE_SEDE);
            $('#lat-edit-'+id).val(element.LATITUD);
            $('#long-edit-'+id).val(element.LONGITUD);
        }
    });
    response.EB.forEach(element => {
        if (element.id == value) {
            $('#station_name-edit-'+id).val(element.sitio);
            $('#lat-edit-'+id).val(element.Latitud);
            $('#long-edit-'+id).val(element.Longitud);
        }
    });
}

function GetSortOrder(prop) {
    return function(a, b) {
        if (a[prop] > b[prop]) {
            return 1;
        } else if (a[prop] < b[prop]) {    
            return -1;
        }
        return 0;
    }
}

function llenarSelect2Edit(response) {
    let elements = $('.select2');
    for (let i = 0; i < elements.length; i++) {
        idEdit = elements[i].id.split('-');
        if (idEdit.length > 1 && idEdit[0] == "department") {
            console.log();
            selectEditDep(idEdit[(idEdit.length - 1)],response);
        }
    }
}

function selectEditDep(id,response) {
    let value = $("#department-edit-"+id).attr('value');
    response.CD.forEach(element => {
        selected = element.DEPARTAMENTO.toUpperCase() == value ? true : false;
        data.push({
            id: element.DEPARTAMENTO.toUpperCase(),
            text: element.DEPARTAMENTO.toUpperCase(),
            selected: selected
        });
    });
    response.EB.forEach(element => {
        selected = element.departamento.toUpperCase() == value ? true : false;
        data.push({
            id: element.departamento.toUpperCase(),
            text: element.departamento.toUpperCase(),
            selected: selected
        });
    });
    dataMap = data.map(item=>{
        return [item.id,item]
    });
    dataMapArr = new Map(dataMap)
    unicos = [...dataMapArr.values()];
    unicos.sort(GetSortOrder("text"));
    $("#department-edit-"+id).select2({
        data: unicos
    }).change(function () {
        let id = this.id.split('-')[(this.id.split('-').length - 1)];
        $("#eb-edit-"+id).empty();
        selectEditMun(id,this.value,response);
    });
    selectEditMun(id,value,response);
}
function selectEditMun(id,value,response) {
    value2 =  $("#municipality-edit-"+id).attr('value');
    data = [];
    response.CD.forEach(element => {
        if (element.DEPARTAMENTO.toUpperCase() == value) {
            selected = element.MUNICIPIOANM.toUpperCase() == value2 ? true : false;
            data.push({
                id: element.MUNICIPIOANM.toUpperCase(),
                text: element.MUNICIPIOANM.toUpperCase(),
                selected: selected
            });
        }
    });
    response.EB.forEach(element => {
        if (element.departamento.toUpperCase() == value) {
            selected = element.municipio.toUpperCase() == value2 ? true : false;
            data.push({
                id: element.municipio.toUpperCase(),
                text: element.municipio.toUpperCase(),
                selected: selected
            });
        }
    });
    dataMap = data.map(item=>{
        return [item.id,item]
    });
    dataMapArr = new Map(dataMap)
    unicos = [...dataMapArr.values()];
    unicos.unshift({
        id: '',
        text: '',
        disabled: true,
        selected: true
    });
    unicos.sort(GetSortOrder("text"));
    $("#municipality-edit-"+id).empty()
    $("#municipality-edit-"+id).select2({
        data: unicos
    }).change(function () {
        let id = this.id.split('-')[(this.id.split('-').length - 1)];
        selectEditEB(id,this.value,response);
    });
    selectEditEB(id,value2,response);
}
function selectEditEB(id,value,response) {
    value2 =  $("#eb-edit-"+id).attr('value');
    data = [];
    response.CD.forEach(element => {
        if (element.MUNICIPIOANM.toUpperCase() == value) {
            selected = element.Consecutivo_Sede.toUpperCase() == value2 ? true : false;
            data.push({
                id: element.Consecutivo_Sede,
                text: (element.INSTITUCIÓN_EDUCATIVA+' '+element.NOMBRE_SEDE).toUpperCase(),
                selected: selected
            });
        }
    });
    response.EB.forEach(element => {
        if (element.municipio.toUpperCase() == value) {
            selected = element.id.toUpperCase() == value2 ? true : false;
            data.push({
                id: element.id,
                text: element.sitio.toUpperCase(),
                selected: selected
            });
        }
    });
    dataMap = data.map(item=>{
        return [item.id,item]
    });
    dataMapArr = new Map(dataMap)
    unicos = [...dataMapArr.values()];
    
    unicos.sort(GetSortOrder("text"));
    unicos.unshift({
        id: 0,
        text: "OTRA"
    });
    unicos.unshift({
        id: '',
        text: '',
        disabled: true,
        selected: true
    });
    $("#eb-edit-"+id).empty();
    $("#eb-edit-"+id).select2({
        data: unicos
    }).change(function () {
        let id = this.id.split('-')[(this.id.split('-').length - 1)];
        selectEditLocation(id,this.value,response);
    });
}