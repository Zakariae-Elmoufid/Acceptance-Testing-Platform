@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 md:pr-10 mb-10 md:mb-0 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Learn to Code, <br>Change Your Future</h1>
                <p class="text-lg text-gray-700 mb-8">YouCode is an innovative school training the digital talents of tomorrow. Join our community and become a professional web developer.</p>
                <a href="" class="px-8 py-3 bg-primary text-white font-semibold rounded-md hover:bg-primary/90 transition-colors shadow-md">Discover Our Programs</a>
            </div>
            
            <div class="md:w-1/2">
                <img src="{{ asset('images/hero-image.jpg') }}" alt="YouCode Students" class="rounded-lg shadow-xl w-full">
            </div>
        </div>
    </section>
    
    <!-- Featured Programs Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Specialized Programs</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Training programs adapted to market needs, designed to make you operational quickly.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Full Stack Program Card -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('images/fullstack.jpg') }}" alt="Full Stack Development" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4 bg-primary text-white text-sm font-semibold px-3 py-1 rounded-full">Featured</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Full Stack Web Development</h3>
                        <p class="text-gray-700 mb-4">Master front-end and back-end technologies to become a versatile developer capable of building complete web applications from the ground up.</p>
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h4 class="font-semibold text-gray-900 mb-2">What you'll learn:</h4>
                            <ul class="space-y-1 text-gray-700">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    HTML, CSS, JavaScript
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    React.js, Vue.js
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    PHP, Laravel
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    MySQL, MongoDB
                                </li>
                            </ul>
                        </div>
                        <a href="" class="inline-block px-6 py-3 border-2 border-primary text-primary font-semibold rounded-md hover:bg-primary hover:text-white transition-colors">Learn More</a>
                    </div>
                </div>
                
                <!-- Data Science Program Card -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow">
                    <div class="relative">
                        <img src="{{ asset('images/datascience.jpg') }}" alt="Data Science" class="w-full h-64 object-cover">
                        <div class="absolute top-4 right-4 bg-primary text-white text-sm font-semibold px-3 py-1 rounded-full">Featured</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Data Science & AI</h3>
                        <p class="text-gray-700 mb-4">Learn to analyze data and create artificial intelligence models to solve complex business problems and drive decision-making.</p>
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <h4 class="font-semibold text-gray-900 mb-2">What you'll learn:</h4>
                            <ul class="space-y-1 text-gray-700">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Python, R
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Machine Learning
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Data Analysis
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-primary mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Data Visualization
                                </li>
                            </ul>
                        </div>
                        <a href="" class="inline-block px-6 py-3 border-2 border-primary text-primary font-semibold rounded-md hover:bg-primary hover:text-white transition-colors">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose YouCode</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">An innovative learning experience that prepares you for the real world of work.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Project-Based Learning</h3>
                    <p class="text-gray-700">Learn by doing real projects that simulate the challenges you'll face in your professional career.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Industry Mentors</h3>
                    <p class="text-gray-700">Learn from experienced professionals working in leading tech companies.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Job Placement</h3>
                    <p class="text-gray-700">Benefit from our network of partner companies to find your first job after graduation.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Partners Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Partners</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">We collaborate with leading companies to offer cutting-edge training and job opportunities.</p>
            </div>
            
            <div class="flex flex-wrap justify-center items-center gap-12">
                <img src="{{ asset('images/partner1.png') }}" alt="Partner Logo" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
                <img src="{{ asset('images/partner2.png') }}" alt="Partner Logo" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
                <img src="{{ asset('images/partner3.png') }}" alt="Partner Logo" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
                <img src="{{ asset('images/partner4.png') }}" alt="Partner Logo" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
                <img src="{{ asset('images/partner5.png') }}" alt="Partner Logo" class="h-12 opacity-70 hover:opacity-100 transition-opacity">
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What Our Students Say</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Discover the success stories of our graduates and their professional journey after YouCode.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/testimonial1.jpg') }}" alt="Student" class="w-14 h-14 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold text-gray-900">Mohammed Hassan</h4>
                            <p class="text-sm text-gray-600">Full Stack Developer at SQLI</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"YouCode transformed my life. In just 7 months, I gained skills I never imagined I could master. Today, I work at an international company with an excellent salary."</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/testimonial2.jpg') }}" alt="Student" class="w-14 h-14 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold text-gray-900">Fatima Zahra</h4>
                            <p class="text-sm text-gray-600">Lead Developer at OCP</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"The pedagogy based on real projects and personalized coaching allowed me to progress quickly. YouCode gave me much more than technical skills: a true developer mindset."</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/testimonial3.jpg') }}" alt="Student" class="w-14 h-14 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold text-gray-900">Younes Berrada</h4>
                            <p class="text-sm text-gray-600">Freelance Web Developer</p>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Thanks to YouCode, I was able to launch my freelance career. The training taught me not only to code but also to manage projects, communicate with clients, and deliver quality work."</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-pink-500 to-primary">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Start Your Career in Tech?</h2>
            <p class="text-xl text-white/90 max-w-3xl mx-auto mb-8">Join YouCode and transform your passion for technology into professional skills in demand.</p>
            <a href="" class="px-8 py-4 bg-white text-primary font-bold rounded-md hover:bg-gray-100 transition-colors shadow-lg">Apply Now</a>
        </div>
    </section>
@endsection