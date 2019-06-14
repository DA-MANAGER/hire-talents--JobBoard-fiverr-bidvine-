<template>
    <div>
        <header-component></header-component>

        <content-component>
            <!--About Header-->
            <div class="jumbotron jumbotron-fluid text-center text-white">
                <div class="container">
                    <h1 class="font-weight-bold">About Us</h1>
                    <p class="lead">Creating a world of work without limits</p>
                </div>
            </div>
            <!--Navigation bar-->
            <div class="container nav-header">
                <ul class="nav nav-tabs justify-content-center flex-column flex-md-row" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#about">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#career">CAREERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#team">OUR TEAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#press">PRESS</a>
                    </li>
                </ul>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                <!--About tab-->
                <div id="about" class="container tab-pane active about-us"><br>
                    <h2>Our story</h2>
                    <p class="story-text">The HireTalentz story begins over a decade ago, when the tech lead of a Silicon Valley startup realized his close friend in Athens would be perfect for a web project. The team agreed he was the best choice, but were concerned about working
                        with someone halfway around the globe.</p>
                    <h3>
                        A new way of working is born
                    </h3>
                    <p>
                        In response, the two friends created a new web-based platform that brought visibility and trust to remote work. It was so successful the two realized other businesses would also benefit from reliable access to a larger pool of quality talent, while workers
                        would enjoy freedom and flexibility to find jobs online. Together they decided to start a company that would deliver on the promise of this technology.
                    </p>
                    <p>
                        Fast-forward to today, that technology is the foundation of Upwork — the largest global freelancing website. With millions of jobs posted on Upwork annually, freelancers are earning money by providing companies with over 5,000 skills across more than
                        70 categories of work.
                    </p>
                    <h3>
                        A world of opportunities
                    </h3>
                    <p>
                        Through Upwork businesses get more done, connecting with freelancers to work on projects from web and mobile app development to SEO, social media marketing, content writing, graphic design, admin help and thousands of other projects. Upwork makes it fast,
                        simple, and cost-effective to find, hire, work with, and pay the best professionals anywhere, any time.
                    </p>
                    <h3>
                        HireTalentz's Vision
                    </h3>
                    <p>
                        To connect businesses with great talent to work without limits.
                    </p>
                    <h3>
                        HireTalentz's Mission
                    </h3>
                    <p>
                        To create economic opportunities so people have better lives.
                    </p>
                    <h3>
                        HireTalentz's Values
                    </h3>
                    <p>
                        Put our community first.
                        <br>Inspire a boundless future of work. <br>Build amazing teams.
                        <br>Have a bias towards action.
                    </p>
                    <!--About social media-->
                    <h3>
                        Join HireTalentz on social
                    </h3>
                    <div class="social-buttons">
                        <i class="fa fa-facebook-square"></i>
                        <i class="fa fa-twitter-square"></i>
                        <i class="fa fa-instagram"></i>
                        <i class="fa fa-linkedin"></i>
                        <i class="fa fa-youtube-square"></i>
                    </div>
                </div>
                <!--Career tab-->
                <div id="career" class="container tab-pane fade career-page text-center"><br>
                    <h2>Work with a purpose. And a smile.</h2>
                    <div class="container text-muted">
                        <!-- Career cards-->
                        <div class="row">
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <img src="img/medal.svg" alt="medal" class="card-img-top career-icons" />
                                        <hr>

                                        <h3 class="card-title">COME JOIN US MAKE HISTORY</h3>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-block">
                                        <img src="img/signpost.svg" alt="medal" class="career-icons" />
                                        <hr>
                                        <h3 class="card-title">PROJECTS YOU’RE PROUD OF</h3>
                                        <p class="card-text">Reinvent an industry, earn a paycheck & work on projects.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-block">

                                        <img src="img/libra.svg" alt="medal" class="career-icons" />
                                        <hr>
                                        <h3 class="card-title">WHISTLE WHILE YOU WORK</h3>
                                        <p class="card-text">Enjoy an awesome healthy work/life balance. </p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--Career tab-->
                    <h2>See what it's like to work for HireTalentz</h2>
                    <h3>A quick look at HireTalentz's people</h3>
                    <div class="row">
                        <div class="person-sample col-md-4">
                            <div class="place-holderimg">
                            </div>
                            <h4>John Doe</h4>
                            <p class="person-jobtitle">SVP, Sales</p>
                            <p class="person-description">Eric leads the Enterprise Sales Team, overseeing daily operations and partnering with organizations around the world to find independent professionals on the Upwork platform.</p>
                        </div>
                        <div class="person-sample col-md-4">
                            <div class="place-holderimg">
                            </div>
                            <h4>John Doe</h4>
                            <p class="person-jobtitle">SVP, Sales</p>
                            <p class="person-description">Eric leads the Enterprise Sales Team, overseeing daily operations and partnering with organizations around the world to find independent professionals on the Upwork platform.</p>
                        </div>
                        <div class="person-sample col-md-4">
                            <div class="place-holderimg">
                            </div>
                            <h4>John Doe</h4>
                            <p class="person-jobtitle">SVP, Sales</p>
                            <p class="person-description">Eric leads the Enterprise Sales Team, overseeing daily operations and partnering with organizations around the world to find independent professionals on the Upwork platform.</p>
                        </div>

                    </div>
                    <!--Career jumbotron-->
                    <div class="jumbotron jumbotron-fluid text-center text-white jumboforce">
                        <h3>
                            Work with us
                        </h3>

                        <a class="btn career-postion-btn" href="#" role="button">Check Our Open Positions</a>
                    </div>
                    <div class="text-left final-paragraphcareer">
                        <h3>
                            Equal Opportunity Employer
                        </h3>
                        <p>
                            HireTalentz is an Equal Opportunity Employer. We are committed to inclusion and diversity. We make every effort to offer employment and advancement opportunities to all qualified candidates. We do not discriminate based upon race, religion, color, national
                            origin, gender (including pregnancy, childbirth, or related medical condition), sexual orientation, gender identity, gender expression, age, status as a protected veteran, status as an individual with a disability, or other applicable
                            legally protected characteristics.
                        </p>
                    </div>

                </div>
                <!--Team tab-->
                <div id="team" class="container tab-pane fade team-page text-center"><br>
                    <h2>Our amazing HireTalentz team</h2>
                    <div class="row">
                        <div class="person-sample col-md-6">
                            <div class="place-holderimg">
                            </div>
                            <h2>John Doe</h2>
                            <hr>
                            <p class="person-jobtitle">SVP, Sales</p>
                            <p class="person-description">Eric leads the Enterprise Sales Team, overseeing daily operations and partnering with organizations around the world to find independent professionals on the Upwork platform.</p>
                        </div>
                        <div class="person-sample col-md-6">
                            <div class="place-holderimg">
                            </div>
                            <h2>John Doe</h2>
                            <hr>
                            <p class="person-jobtitle">SVP, Sales</p>
                            <p class="person-description">Eric leads the Enterprise Sales Team, overseeing daily operations and partnering with organizations around the world to find independent professionals on the Upwork platform.</p>
                        </div>
                    </div>
                    <!--Team jumbotron-->
                    <div class="jumbotron jumbotron-fluid team-jumbo text-center text-black-50 jumboforce">
                        <h3>
                            Our Associated Brands
                        </h3>
                        <div class="row">
                            <div class="brand-logos col-md-2">
                                <div>
                                    <img src="img/hiretalentzlogo.png" alt="logo" class="brand-samples" />
                                </div>
                            </div>
                            <div class="brand-logos col-md-2">
                                <div>
                                    <img src="img/hiretalentzlogo.png" alt="logo" class="brand-samples" />
                                </div>
                            </div>
                            <div class="brand-logos col-md-2">
                                <div>
                                    <img src="img/hiretalentzlogo.png" alt="logo" class="brand-samples" />
                                </div>
                            </div>
                            <div class="brand-logos col-md-2">
                                <div>
                                    <img src="img/hiretalentzlogo.png" alt="logo" class="brand-samples" />
                                </div>
                            </div>
                            <div class="brand-logos col-md-2">
                                <div>
                                    <img src="img/hiretalentzlogo.png" alt="logo" class="brand-samples" />
                                </div>
                            </div>
                            <div class="brand-logos col-md-2">
                                <div>
                                    <img src="img/hiretalentzlogo.png" alt="logo" class="brand-samples" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Press tab-->
                <div id="press" class="press-page container tab-pane fade text-center"><br>
                    <h2>HireTalentz in the news</h2>
                    <div class="container text-muted">
                        <!--press news cards-->
                        <div class="row news-tab">
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="img/pexels-photo-56759.jpeg" alt="medal" class="img-fluid card-img-top">
                                    </div>
                                    <div class="card-block news-card">
                                        <h3 class="card-title">Post Title</h3>
                                        <hr>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="date-card">November 21, 2018</p>
                                        <a class="btn btn-success" href="#" role="button">Read more...</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="img/pexels-photo-1181347.jpeg" alt="medal" class="img-fluid card-img-top">
                                    </div>
                                    <div class="card-block news-card">
                                        <h3 class="card-title">Post Title</h3>
                                        <hr>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="date-card">November 21, 2018</p>
                                        <a class="btn btn-success" href="#" role="button">Read more...</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="img/pexels-photo-1181571.jpeg" alt="medal" class="img-fluid card-img-top">
                                    </div>
                                    <div class="card-block news-card">
                                        <h3 class="card-title">Post Title</h3>
                                        <hr>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="date-card">November 21, 2018</p>
                                        <a class="btn btn-success" href="#" role="button">Read more...</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="img/pexels-photo-1002634.jpeg" alt="medal" class="img-fluid card-img-top">
                                    </div>
                                    <div class="card-block news-card">
                                        <h3 class="card-title">Post Title</h3>
                                        <hr>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="date-card">November 21, 2018</p>
                                        <a class="btn btn-success" href="#" role="button">Read more...</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="img/pexels-photo-1181671.jpeg" alt="medal" class="img-fluid card-img-top">
                                    </div>
                                    <div class="card-block news-card">
                                        <h3 class="card-title">Post Title</h3>
                                        <hr>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="date-card">November 21, 2018</p>
                                        <a class="btn btn-success" href="#" role="button">Read more...</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-img">
                                        <img src="img/pexels-photo-1251861.jpeg" alt="medal" class="img-fluid card-img-top">
                                    </div>
                                    <div class="card-block news-card">
                                        <h3 class="card-title">Post Title</h3>
                                        <hr>
                                        <p class="card-text">Help bring online work to every corner of the world.</p>
                                    </div>
                                    <div class="card-footer">
                                        <p class="date-card">November 21, 2018</p>
                                        <a class="btn btn-success" href="#" role="button">Read more...</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--press jumbotron-->
                    <div class="jumbotron jumbotron-fluid text-center text-white jumboforce">
                        <h3>
                            Press Inquiries
                        </h3>
                        <a class="btn career-postion-btn" href="#" role="button">Press@hire-talentz.com</a>
                    </div>
                </div>
            </div>
        </content-component>

        <footer-component></footer-component>

        <link rel="stylesheet" href="css/StyleSheet.css">
    </div>
</template>

<script>
import ContentComponent from "./../modules/ContentComponent.vue";
import FooterComponent from "./../modules/FooterComponent.vue";
import HeaderComponent from "./../modules/HeaderComponent.vue";

export default {
	components: {
		ContentComponent,
		FooterComponent,
		HeaderComponent,
	},
};
</script>