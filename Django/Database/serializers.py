
from rest_framework import serializers

from .models import Test
from .models import Test10000
from .models import Test100000


class TestSerializer(serializers.ModelSerializer):
  name = serializers.CharField(max_length=1000, required=True)
  age = serializers.IntegerField(required=True)

  def create(self, validated_data):
    return Test.objects.create(
      name=validated_data.get('name'), age=validated_data.get('age')
    )

  def update(self, instance, validated_data):

    instance.name = validated_data.get('name', instance.name)
    instance.age = validated_data.get('age', instance.age)
    instance.save()
    return instance

  class Meta:
    model = Test
    fields = (
      'id',
      'name',
      'age'
    )

class Test10000Serializer(serializers.ModelSerializer):
   class Meta:
       model = Test10000
       fields = (
         'id',
         'name',
         'age'
       )

class Test100000Serializer(serializers.ModelSerializer):
   class Meta:
       model = Test100000
       fields = (
         'id',
         'name',
         'age'
       )