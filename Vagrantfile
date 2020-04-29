# -*- mode: ruby -*-
# vi: set ft=ruby :

project_name = "stop-covid"
ip_address = "192.168.200.47"

# Laravel development box over Ubuntu 16.04 LTS
Vagrant.configure("2") do |config|

  # Configure the box
  config.vm.box = "laravel"
  config.vm.box_version = "~>3.3"
  config.vm.box_url = "http://vagrant.soyhuce.lan/api/boxes/laravel"
  config.vm.define project_name

  config.vm.provider "virtualbox" do |vb|
    vb.name = project_name
    vb.linked_clone = true
  end

  # Configure host manager
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.vm.hostname = project_name + ".local"
  config.hostmanager.aliases = ["api.stop-covid.local"]
  config.vm.network :private_network, ip: ip_address

  config.vm.provision :hostmanager

  # Jump to /vagrant when vagrant ssh
  config.vm.provision "shell", inline: <<-SHELL
    echo 'cd /vagrant' >> /home/vagrant/.bashrc
  SHELL

  config.vm.provision "shell", inline: <<-SHELL
    rm -rf /var/www
    ln -s /vagrant /var/www

    #cp /vagrant/supervisord.conf /etc/supervisor/conf.d/
	  #sed -i 's/user=www-data/user=vagrant/g' /etc/supervisor/conf.d/supervisord.conf
    #service supervisor restart
  SHELL

  config.vm.provision "shell", inline: <<-SHELL
    sudo -u postgres psql -c 'alter role vagrant with superuser'
    sudo -u postgres psql -c 'alter role vagrant with createrole'
    sudo -u postgres psql -c 'alter role vagrant with createdb'
  SHELL
end
