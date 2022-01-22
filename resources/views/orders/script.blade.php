<script>
        
    const app = new Vue({
        el: '#dev-category',
        data(){
            return{
                shopping:"",
                shoppings:[],
                links:[],
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link bg-main",
                showMenu:false,

                links:[],
                currentPage:"",
                totalPages:"",

            }
        },
        methods:{

            show(shopping){

                this.shopping = shopping
                console.log(this.shopping)

            },
            fetch(page = 1){


                axios.get("{{ route('orders.fetch') }}")
                .then(res => {

                    this.shoppings = res.data.data
                    this.links = res.data.links
                    this.currentPage = res.data.current_page
                    this.totalPages = res.data.last_page

                })
                .catch(err => {
                    $.each(err.response.data.errors, function(key, value){
                        alert(value)
                    });
                })

            },
            toggleMenu(){

                if(this.showMenu == false){
                    $("#menu").addClass("show")
                    this.showMenu = true
                }else{
                    $("#menu").removeClass("show")
                    this.showMenu = false
                }

            }


        },
        mounted(){
            
            this.fetch()

        }

    })

</script>