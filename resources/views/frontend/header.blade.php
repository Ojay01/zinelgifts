import React, { useState } from 'react';
import { Search, ShoppingCart, Heart, Menu, X } from 'lucide-react';

const Header = () => {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  return (
    <header className="font-sans bg-black text-yellow-500">
      {/* Top bar */}
      <div className="border-b border-yellow-500 border-opacity-20 hidden sm:block">
        <div className="container mx-auto px-4 py-2 flex flex-wrap justify-between items-center text-xs">
          <div className="flex space-x-4 mb-2 sm:mb-0">
            <span>ENGLISH</span>
            <span>COUNTRY</span>
          </div>
          <div className="w-full sm:w-auto text-center mb-2 sm:mb-0">FREE SHIPPING FOR ALL ORDERS OF $150</div>
          <div className="flex flex-wrap justify-center sm:justify-end space-x-4">
            <a href="#" aria-label="Facebook"><i className="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Twitter"><i className="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i className="fab fa-instagram"></i></a>
            <a href="#" aria-label="YouTube"><i className="fab fa-youtube"></i></a>
            <a href="#" aria-label="Pinterest"><i className="fab fa-pinterest-p"></i></a>
            <a href="#" className="uppercase">Newsletter</a>
            <a href="#" className="uppercase">Contact Us</a>
            <a href="#" className="uppercase">FAQs</a>
          </div>
        </div>
      </div>

      {/* Main header */}
      <div className="container mx-auto px-4 py-4">
        <div className="flex justify-between items-center">
          <div className="flex items-center space-x-4">
            <img src="/path-to-woodmart-logo.png" alt="zinelgift" className="h-8" />
            <button onClick={() => setMobileMenuOpen(!mobileMenuOpen)} className="sm:hidden">
              {mobileMenuOpen ? <X size={24} /> : <Menu size={24} />}
            </button>
          </div>
          <div className="hidden sm:flex items-center space-x-4">
            <div className="relative">
              <input
                type="text"
                placeholder="Search for products"
                className="border border-yellow-500 bg-black text-yellow-500 rounded-full py-2 px-4 pr-10 w-full sm:w-64 placeholder-yellow-500 placeholder-opacity-50"
              />
              <Search className="absolute right-3 top-2.5 text-yellow-500" size={20} />
            </div>
            <select className="border border-yellow-500 rounded-full py-2 px-4 bg-black text-yellow-500">
              <option>SELECT CATEGORY</option>
            </select>
          </div>
          <div className="flex items-center space-x-4">
            <a href="#" className="text-sm font-medium hidden sm:inline">LOGIN / REGISTER</a>
            <Heart className="text-yellow-500" size={24} />
            <div className="relative">
              <ShoppingCart className="text-yellow-500" size={24} />
              <span className="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
            </div>
            <span className="font-medium hidden sm:inline">$0.00</span>
          </div>
        </div>
      </div>

      {/* Navigation */}
      <nav className="border-t border-yellow-500 border-opacity-20">
        <div className="container mx-auto px-4">
          <ul className={`flex flex-col sm:flex-row sm:items-center sm:space-x-6 py-4 ${mobileMenuOpen ? 'block' : 'hidden sm:flex'}`}>
            <li className="font-medium uppercase mb-2 sm:mb-0">Browse Categories</li>
            <li className="mb-2 sm:mb-0"><a href="#" className="hover:text-yellow-400">Home</a></li>
            <li className="mb-2 sm:mb-0"><a href="#" className="hover:text-yellow-400">Shop</a></li>
            <li className="mb-2 sm:mb-0"><a href="#" className="hover:text-yellow-400">Blog</a></li>
            <li className="mb-2 sm:mb-0"><a href="#" className="hover:text-yellow-400">Pages</a></li>
            <li className="mb-2 sm:mb-0"><a href="#" className="hover:text-yellow-400">Elements</a></li>
            <li className="mb-2 sm:mb-0"><a href="#" className="hover:text-yellow-400">Buy</a></li>
            <li className="sm:ml-auto mb-2 sm:mb-0"><a href="#" className="text-yellow-300 hover:text-yellow-200">Special Offer</a></li>
            <li><a href="#" className="uppercase font-medium">Purchase Theme</a></li>
          </ul>
        </div>
      </nav>

      {/* Mobile search (outside of main nav for better UX) */}
      <div className="sm:hidden px-4 pb-4">
        <div className="relative">
          <input
            type="text"
            placeholder="Search for products"
            className="border border-yellow-500 bg-black text-yellow-500 rounded-full py-2 px-4 pr-10 w-full placeholder-yellow-500 placeholder-opacity-50"
          />
          <Search className="absolute right-3 top-2.5 text-yellow-500" size={20} />
        </div>
      </div>
    </header>
  );
};

export default Header;