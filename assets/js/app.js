new Vue({
    el: '#page',
    data: {
        sideMenuOpen: false,
        sideMenuList: [
            {
                'label': 'About',
                'url' : 'about.html'
            },
            {
                'label': 'Portofolio',
                'url' : 'item-directory.html'
            },
            {
                'label': 'Class',
                'url' : 'class.html'
            },
            {
                'label': 'Articles',
                'url' : 'articles.html'
            },
            {
                'label': 'Research',
                'url' : 'research.html'
            },
            {
                'label': 'Awards',
                'url' : 'awards.html'
            },
            {
                'label': 'Shop',
                'url' : 'shop.html'
            }
        ],
        dummyFoto: [
            'https://d2huqozv2aqnkj.cloudfront.net/wp-content/uploads//2018/01/kompas_tark_5764599_133_1-720x480.jpeg',
            'https://i.pinimg.com/originals/e4/81/cb/e481cbc93bb6e063fe3029186383c855.jpg',
            'https://i1.wp.com/suwatu.com/gambar/Awang-awang-Sky-View-Magelang.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTm84BIrkKS9bFKRq8RWd-cbHObZ34mjbbpAQ&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGN6Udf1N7ueV0C0_VBG0Ys6k5C2ls9I70AA&usqp=CAU',
            'https://d2huqozv2aqnkj.cloudfront.net/wp-content/uploads//2018/01/kompas_tark_5764599_133_1-720x480.jpeg',
            'https://i.pinimg.com/originals/e4/81/cb/e481cbc93bb6e063fe3029186383c855.jpg',
            'https://i1.wp.com/suwatu.com/gambar/Awang-awang-Sky-View-Magelang.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTm84BIrkKS9bFKRq8RWd-cbHObZ34mjbbpAQ&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGN6Udf1N7ueV0C0_VBG0Ys6k5C2ls9I70AA&usqp=CAU'
        ],
        dummyPartenrship: [
            'assets/images/partner-1.png',
            'assets/images/partner-3.png',
            'assets/images/partner-2.png'
        ],
        swiperJumbotron: '',
        swiperWork: '',
        tabWorkDetail: 0
    },
    methods: {
        initSwiperJumbotron() {
            this.swiperJumbotron = new Swiper(".swiper--jumbotron", {
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: true,
                },
                pagination: {
                    el: ".swiper--jumbotron--pagination",
                },
                navigation: {
                    nextEl: ".swiper--jumbotron--next",
                    prevEl: ".swiper--jumbotron--prev",
                }
            });
        },
        initSwiperWork() {
            this.swiperWork = new Swiper(".swiper--work", {
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: ".swiper--work--next",
                    prevEl: ".swiper--work--prev",
                }
            });
        },
        resizeMasonryItem(item){
            var grid = document.getElementsByClassName('masonry')[0],
                rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap')),
                rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
            console.log(rowGap, rowHeight)
            var rowSpan = Math.ceil((item.querySelector('.masonry-content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
            item.style.gridRowEnd = 'span '+rowSpan;
            item.querySelector('.masonry-content').style.height = rowSpan * 10 + "px";
        },
        resizeAllMasonryItems(){
            var allItems = document.getElementsByClassName('masonry-item');
            for(var i=0;i>allItems.length;i++){
              this.resizeMasonryItem(allItems[i]);
            }
        },
        waitForImages() {
            const _self = this
            var allItems = document.getElementsByClassName('masonry-item');
            for(var i=0;i<allItems.length;i++){
              imagesLoaded( allItems[i], function(instance) {
                var item = instance.elements[0];
                _self.resizeMasonryItem(item);
              } );
            }
        }

    },
    mounted(){
        this.$nextTick(() => {
            const _self = this
            _self.initSwiperJumbotron()
            _self.initSwiperWork()
            _self.waitForImages()
            var masonryEvents = ['load', 'resize'];
            masonryEvents.forEach( function(event) {
                window.addEventListener(event, _self.resizeAllMasonryItems);
            } );
        });
    },
})