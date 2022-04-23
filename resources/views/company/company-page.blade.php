@extends('company.company-main')
@section('content')

<main id="main">

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
  
          <div class="row gy-4">
  
            <section id="faq" class="faq section-bg">
            <div class="container">
      
              <div class="section-title" data-aos="fade-up">
                <h2>Kažkas</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
              </div>

            </div>
          </section><!-- End Frequently Asked Questions Section -->

            <div class="col-lg-6">
                <div class="portfolio-description">
                  <h2>Jei jau esate užsiregistravę</h2>
                  <p>
                    Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
                  </p>
                </div>
                <h4><a class="getstarted" href="{{route('register')}}">Prisijungti</a></h4>
              </div>
  
            <div class="col-lg-6">
              <div class="portfolio-description">
                <h2>Jei norite užsiregistruoti į sistemą</h2>
                <p>
                  Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
                </p>
              </div>
              <h4><a class="getstarted" href="{{route('company.request')}}">Pildyti registracijos formą</a></h4>
            </div>
          </div>
        </div>
      </section><!-- End Portfolio Details Section -->
  


  
   </main><!-- End #main -->

@endsection