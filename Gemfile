source 'https://rubygems.org'

require 'json'
require 'open-uri'
versions = JSON.parse(open('https://pages.github.com/versions.json').read)

gem 'github-pages', versions['github-pages']
gem 'jekyll-sitemap', versions['jekyll-sitemap']
gem 'jekyll-redirect-from', versions['jekyll-redirect-from']
