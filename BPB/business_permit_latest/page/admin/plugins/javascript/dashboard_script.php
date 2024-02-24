<script type="text/javascript">
$(function(){
    my_chart_fetch_graph();
});


const my_chart_fetch_graph =()=>{
    $.ajax({
        url:'../../process/admin/processor.php',
                type: 'POST',
                cache: false,
                data:{
                    method: 'total_graph',
                },success:function(response){
                  document.getElementById('graph_req').innerHTML = response;
                    var dept = [];
                    $('.dept').each(function(){
                        dept.push($(this).html());
                    });
                     var pending = [];
                    $('.pending').each(function(){
                        pending.push($(this).html());
                    });

                     var aprpoved = [];
                    $('.aprpoved').each(function(){
                        aprpoved.push($(this).html());
                    });

                    chart_total_graph(dept,pending,aprpoved);
                }
    });
}


const chart_total_graph = (dept, pending, aprpoved) => {
    // Get the canvas element
    let ctx = document.getElementById('myChart');
    
    // Check if a chart with the ID '0' exists and destroy it
    let existingChart = Chart.getChart(ctx);
    if (existingChart) {
        existingChart.destroy();
    }
    
    // Create the new chart
    const mixedChart = new Chart(ctx, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'For Approval',
                data: pending,
                // this dataset is drawn below
                order: 2,
                backgroundColor: [
                    'rgb(110, 134, 135)'
                ],
                borderWidth: 1
            }, {
                label: 'Approved',
                data: aprpoved,
                type: 'bar',
                // this dataset is drawn on top
                order: 1,
                backgroundColor: [
                    'rgb(35, 141, 207)'
                ],
                borderWidth: 1
            }],
            labels: dept
        }
        // options: options
    });
}
 
</script>