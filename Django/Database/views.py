from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework.mixins import UpdateModelMixin, DestroyModelMixin
import aiohttp
import asyncio
from django.shortcuts import render
from django.http import *
from channels.db import database_sync_to_async
from asgiref.sync import sync_to_async
from .models import Test
from .models import Test10000
from .models import Test100000
from .serializers import TestSerializer
from .serializers import Test10000Serializer
from .serializers import Test100000Serializer
import json
import time



class SimpleGetView():
    async def get(request):
        return HttpResponse({'HealthStatus: Web service is working'}, status=200)

class TestView(
  APIView,
  UpdateModelMixin,
  DestroyModelMixin,
):
  async def post(request):
      if request.method == 'POST':     
        create_serializer = TestSerializer(data=json.loads(request.body))

        if create_serializer.is_valid():
          Test_item_object = await sync_to_async(create_serializer.save)()
          read_serializer = TestSerializer(Test_item_object)
          return HttpResponse(read_serializer.data, status=200)

        return HttpResponse(create_serializer.errors, status=400)
      else:
          return HttpResponse("", status=400)


  async def put(request, id=None):
      if request.method == 'PUT':  
        try:
          Item = await sync_to_async(Test.objects.get)(id=id)
        except Test.DoesNotExist:
          return Response({'errors': 'This client item does not exist.'}, status=400)
        update_serializer = TestSerializer(Item, data=json.loads(request.body))
        if update_serializer.is_valid():
          Item_object = await sync_to_async(update_serializer.save)()
          read_serializer = TestSerializer(Item_object)
          return HttpResponse(read_serializer.data, status=200)
        return HttpResponse(update_serializer.errors, status=400)
      else:
        return HttpResponse("", status=400)

  
  async def delete(request, id=None):
    if request.method == 'DELETE':
        try:
          Item = await sync_to_async(Test.objects.get)(id=id)
        except Test.DoesNotExist:
          return HttpResponse({'errors': 'This client does not exist.'}, status=200)

        await sync_to_async(Item.delete)()
        return HttpResponse("Deleted", status=200)
    else:
        return HttpResponse("", status=400)

class Test10000View(
  APIView,
  UpdateModelMixin,
  DestroyModelMixin,  
):
    async def get(request):
        if request.method == 'GET':
            queryset = await sync_to_async(list)(Test10000.objects.all())

            read_serializer = Test10000Serializer(queryset, many=True)

            return HttpResponse(read_serializer.data)
        else:
            return HttpResponse("", status=400)

class Test100000View(
  APIView,
  UpdateModelMixin,
  DestroyModelMixin,  
):
    async def get(request):
        if request.method == 'GET':
            queryset = await sync_to_async(list)(Test100000.objects.all())

            read_serializer = Test100000Serializer(queryset, many=True)

            return HttpResponse(read_serializer.data)
        else:
            return HttpResponse("", status=400)

async def download(request):
    if request.method == 'GET':
        image_data = await start_download()
        return HttpResponse(image_data[0], content_type="image/png")
    else:
        return HttpResponse("", status=400)

async def start_download():
    image_data = []
    async for i in async_download():
        image_data.append(i)
    return image_data

async def async_download():
    async with aiohttp.ClientSession() as session:
        for i in range(10):
            async with session.get("https://picsum.photos/200/300") as resp:
                data = await resp.read()
                yield data 