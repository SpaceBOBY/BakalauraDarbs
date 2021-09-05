
from django.urls import path

from . import views

urlpatterns = [
  path('SimpleGet', views.SimpleGetView.get),
  path('Insert', views.TestView.post),
  path('Update/<int:id>', views.TestView.put),
  path('Delete/<int:id>', views.TestView.delete),
  path('Get10000', views.Test10000View.get),
  path('Get100000', views.Test100000View.get),
  path('Download', views.download)
  ];