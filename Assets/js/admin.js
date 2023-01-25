var url_base=window.location.origin+"/"+window.location.pathname.split("/")[1];
window.onload=()=>{
    $("#curso").change(()=>{
       let idcurso=$("#curso").val();
       $.ajax({
        url:url_base+"/api/alumnoscurso/"+idcurso,
        success:(datos)=>{
            console.log(datos);
        },
        error:(err)=>{
            console.log(err);
        }
       })
    })
}