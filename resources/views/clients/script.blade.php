<script>
    
    const app = new Vue({
        el: '#dev-client',
        data(){
            return{
                clients:[],
                links:[],
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link bg-main",
                showMenu:false,
            }
        },
        methods:{
        
            async fetch(link = "{{ route('clients.fetch') }}"){

                let res = await axios.get("{{ route('clients.fetch') }}")
                this.clients = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

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