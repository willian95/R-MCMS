<script>
        
    const app = new Vue({
        el: '#dev-coupon',
        data(){
            return{

                loading:false,
                coupons:[],
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link",
                users:[],
                products:[],
                allUsers:false,
                allProducts:false,
                showMenu:false
            }
        },
        methods:{   

            currencyFormatDE(num) {
                return (
                    num
                    .toFixed(2) // always two decimal digits
                    .replace('.', ',') // replace decimal point character with ,
                    .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
                ) // use . as a separator
            },
            
            create(){
                this.action = "create"
                this.name = ""
                this.ml = ""
                this.sizeId = ""
            },
            setUsers(coupon){
                

                if(coupon.all_users == 1){

                    this.allUsers = coupon.all_users

                }else{
                    this.allUsers = 0
                    this.users = coupon.coupon_users

                }

            },
            setProducts(coupon){
                
                if(coupon.all_products == 1){

                    this.allProducts = coupon.all_products

                }else{
                    this.allProducts = 0
                    this.products = coupon.coupon_product_formats

                }

            },
            async fetch(link = ""){

                this.loading = true
                let res = await axios.get(link == "" ? "{{ url('coupons/fetch') }}" : "{{ url('coupons/fetch') }}"+"?page="+link)

                this.loading = false
                this.coupons = res.data.coupons.data
                this.currentPage = res.data.coupons.current_page
                this.totalPages = res.data.coupons.last_page


            },
            erase(id){

                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás este cupón!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ url('coupons/delete/') }}", {id: id}).then(res => {
                            this.loading = false
                            if(res.data.success == true){
                                swal({
                                    title: "Genial!",
                                    text: "Cupón eliminado!",
                                    icon: "success"
                                });
                                this.fetch()
                            }else{

                                alert(res.data.msg)

                            }

                        }).catch(err => {
                            this.loading = false
                            $.each(err.response.data.errors, function(key, value){
                                alert(value)
                            });
                        })

                    }
                });

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